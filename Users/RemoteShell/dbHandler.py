import subprocess
import sys
import pymysql
import operator

class dbHandler:

   max_storage = 8192
   max_hours = 168
   efficient = 3500
   query = 'SELECT Rp_Specs.Mac ,Rp_Specs.HasCamera, Current_Specs.FreeStorage ,Current_Specs.CpuUsage ,Current_Specs.Temperature ,Rp_Log.Jobs_Num , TIMESTAMPDIFF(HOUR,Rp_Log.Start_time,NOW()) AS time FROM Rp_Log INNER JOIN Rp_Specs ON Rp_Log.Mac = Rp_Specs.Mac INNER JOIN Current_Specs ON Rp_Specs.Mac = Current_Specs.Mac ORDER BY rand()'
  

   def __init__(self):
      self.db = pymysql.connect(host='localhost',user='root',password='eits2017',db='EITS')
      self.cursor =  self.db.cursor(pymysql.cursors.DictCursor)

   def getMac(self):
     rp = {}
     best = -1
     temp = "none"
     try:
        self.cursor.execute(self.query)
        results = self.cursor.fetchall()
        for row in results:
            Mac = row["Mac"]
            Camera = row["HasCamera"]
            FreeStorage = row["FreeStorage"]
            CPU = row["CpuUsage"]
            Temperature = row["Temperature"]
            Jobs_Num = row["Jobs_Num"]
            time = row["time"]
            rp[Mac] = dbHandler.get_points(self,Camera,FreeStorage,CPU,Temperature,Jobs_Num,time)
            if rp[Mac] > best:
                best = rp[Mac]
                temp = Mac
        return temp
     except Exception as e:
      print(e)


   def get_points(self,Camera,FreeStorage,CPU,Temperature,Jobs_Num,time):
     total = 0
     total += 600 * (3 - Jobs_Num)
     total += 1000 * (1- Camera)
     total += 12 * (100 -CPU)
     total += 5 * (((self.max_storage - FreeStorage) / self.max_storage )* 100 )
     total += 10 * (80 - Temperature)
     total += 2 * (self.max_hours - time)
     return total


   def getSpecs(self,Mac):
     query2 = "SELECT username , password , private_ip  FROM `Rp_Specs` WHERE Mac = \""+ Mac+" \""
     try:
       self.cursor.execute(query2)
       results = self.cursor.fetchall()
       for row  in results:
           result = row["username"]
           result = result + ":"+row["password"]
           result = result + ":"+row["private_ip"]           
       return result
     except Exception as e:
       print(e)
     


