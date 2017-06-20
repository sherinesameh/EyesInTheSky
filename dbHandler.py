import subprocess
import sys
import pymysql
import operator

class dbHandler:

   def __init__(self, user):
      if user == 'admin':
          self.db = pymysql.connect(host='localhost',user='root',password='sherine',db='EITS')
      elif user == 'pi':
          self.db = pymysql.connect(host='46.101.180.169',user='pi',password='eits2017',db='EITS')
      self.cursor =  self.db.cursor(pymysql.cursors.DictCursor)

   def get_points(self,Camera,FreeStorage,CPU,Temperature,Jobs_Num,time):
    max_storage = 8192
    max_hours = 168
    efficient = 3500

     total = 0
     total += 600 * (3 - Jobs_Num)
     total += 1000 * (1- Camera)
     total += 12 * (100 -CPU)
     total += 5 * (((self.max_storage - FreeStorage) / self.max_storage )* 100 )
     total += 10 * (80 - Temperature)
     total += 2 * (self.max_hours - time)
     return total

   def getBestPi(self):
     rp = {}
     best = -1
     temp = "none"

     query = 'SELECT Rp_Specs.Mac ,Rp_Specs.HasCamera, Current_Specs.FreeStorage ,Current_Specs.CpuUsage ,Current_Specs.Temperature ,Rp_Log.Jobs_Num , TIMESTAMPDIFF(HOUR,Rp_Log.Start_time,NOW()) AS time FROM Rp_Log INNER JOIN Rp_Specs ON Rp_Log.Mac = Rp_Specs.Mac INNER JOIN Current_Specs ON Rp_Specs.Mac = Current_Specs.Mac ORDER BY rand()'
    #  query2 =  'UPDATE Rp_Log SET  Jobs_Num = Jobs_Num + 1 WHERE 1'
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

   def incrementPi(self,mac):
     query = 'UPDATE `Rp_Log` SET `Jobs_Num`=Jobs_Num + 1 WHERE Mac = \'' + mac + '\''
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

   def decrementPi(self,mac):
     query = 'UPDATE `Rp_Log` SET `Jobs_Num`=Jobs_Num - 1 WHERE Mac = \'' + mac + '\''
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

   def addProcess(containerID , imgID , IPAddress , port, userID ,processName , mac):
     query =  "INSERT INTO `Process`(`Img_id`, `Process_name`, `Cont_id`, `Cont_IP`, `Mac`, `User_id`,   `Process_State`) VALUES (\'"+imgID+"\',\'"+processName+"\',\'" +containerID +"\',\'"+ IPAddress + "\',\'" + mac+ "\',\'" + userID + "\', 22894)"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

   def adminKill(Admin_id , mac , Cont_id):
     query =  "INSERT INTO `Admin_Log`(`Admin_id`, `The_Actions`, `Mac` , `Cont_id`) VALUES ("+Admin_id+","+27693+",\'"+mac+"\',\'"+Cont_id+"\')"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

   def shutPi(AdminID, mac ) :
     query =  "INSERT INTO `Admin_Log`(`Admin_id`, `The_Actions`, `Mac` , `Cont_id`) VALUES ("+Admin_id+","+12030+",\'"+mac+"\',\'None\')"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)
     query =  "UPDATE `Process` SET `Process_State`="+22198+" WHERE Mac = \'"+mac+"\'"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

   def restartPi(AdminID, mac ) :
     query =  "INSERT INTO `Admin_Log`(`Admin_id`, `The_Actions`, `Mac` , `Cont_id`) VALUES ("+Admin_id+","+23456+",\'"+mac+"\',\'None\')"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)
     query =  "UPDATE `Process` SET `Process_State`="+22198+" WHERE Mac = \'"+mac+"\'"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

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

   def updateSpecs(self, Mac, CPU_temp, CPU_used, RAM_used, DISK_perc):
      query = 'UPDATE Current_Specs SET Temperature = CPU_temp , CpuUsage = CPU_used, RamUsage =RAM_used, FreeStorage = DISK_perc WHERE Mac = \''+Mac+'\''
      try:
         self.cursor.execute(query)
         self.db.commit()
      except Exception as e:
         self.db.rollback()
