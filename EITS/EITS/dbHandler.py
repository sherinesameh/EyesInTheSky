import subprocess
import sys
import pymysql
import operator

class dbHandler:
   def __init__(self):
       # self.db = pymysql.connect(host='46.101.180.169', port= 3306, user='pi',password='eits2017',db='EITS')
       self.db = pymysql.connect(host='localhost',user='root',password='Pi',db='EITS')
       self.cursor =  self.db.cursor(pymysql.cursors.DictCursor)

   def get_points(self,Camera,FreeStorage,CPU,RAM,Temperature,Jobs_Num,time):
      max_storage = 8192
      max_hours = 168
      efficient = 3500

      total = 0
      total += 600 * (3 - Jobs_Num)
      total += 1000 * (1- Camera)
      total += 12 * (100 -CPU)
      total += 8 * (100 - RAM)
      total += 5 * (100 - FreeStorage )
      total += 10 * (80 - Temperature)
      total += 2 * (max_hours - time)
      return total

   def getBestPi(self):
     rp = {}
     best = -1
     temp = "none"

     query = 'SELECT Rp_Specs.Mac ,Rp_Specs.HasCamera, Current_Specs.FreeStorage , Current_Specs.RamUsage ,Current_Specs.CpuUsage ,Current_Specs.Temperature ,Rp_Log.Jobs_Num , TIMESTAMPDIFF(HOUR,Rp_Log.Start_time,NOW()) AS time FROM Rp_Log INNER JOIN Rp_Specs ON Rp_Log.Mac = Rp_Specs.Mac INNER JOIN Current_Specs ON Rp_Specs.Mac = Current_Specs.Mac  WHERE Current_Specs.State = 22894 ORDER BY rand()'
     try:
        self.cursor.execute(query)
        results = self.cursor.fetchall()
        print("3dad el results "+str(len(results)))
        for row in results:
            Mac = row["Mac"]
            Camera = row["HasCamera"]
            FreeStorage = row["FreeStorage"]
            CPU = row["CpuUsage"]
            Temperature = row["Temperature"]
            Jobs_Num = row["Jobs_Num"]
            RamUsage = row["RamUsage"]
            time = row["time"]
            rp[Mac] = dbHandler.get_points(self,Camera,FreeStorage,CPU,RamUsage,Temperature,Jobs_Num,time)
            print("Mac "+Mac + " points "+str(rp[Mac]))
            if rp[Mac] > best:
                best = rp[Mac]
                temp = Mac
        return temp
     except Exception as e:
      print(e)



   def addPi(self , ip , mac , os , ram , disk , camera):     
     query1 = "SELECT `Mac` FROM `Rp_Specs` WHERE Mac = \'"+mac+"\'"
     try:
        self.cursor.execute(query1)
        results = self.cursor.fetchall()
        print("el results " + str(len(results)))
        if len(results) == 0:
           query2 = "INSERT INTO `Rp_Specs`(`Mac`, `Ram`, `Storage`, `HasCamera`,  `OS`,  `PublicIP`) VALUES (\'"+mac+"\',"+str(ram)+","+str(disk)+","+str(camera)+",\'"+os+"\',\'"+ip+"\')"
           self.cursor.execute(query2)
           self.db.commit()
           query4 = "INSERT INTO `Current_Specs`(`Mac`, `PrivateIP`, `FreeStorage`, `CpuUsage`, `RamUsage`, `Temperature`, `State`) VALUES (\'"+mac+"\' ,'0',0,0,0,0,22894)"
           self.cursor.execute(query4)
           self.db.commit()
           query5 = "INSERT INTO `Rp_Log`(`Mac`, `Jobs_Num`) VALUES ( \'"+mac+"\',0)"
           self.cursor.execute(query5)
           self.db.commit()        
        else:
           query3 = "UPDATE `Rp_Specs` SET `Ram`= "+ str(ram) + ",`Storage`= " + str(disk) + ",`HasCamera`= " + str(camera) + ", `OS`= \'"+os+"\' WHERE Mac = \'"+mac+"\'"   
           self.cursor.execute(query3)
           self.db.commit()
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
   

   def getCameraPis(self):
     query = "SELECT `Mac` FROM `Rp_Specs` WHERE HasCamera = 1";
     self.cursor.execute(query)
     macs = []
     results = self.cursor.fetchall()
     for x in results:
         macs.append(x["Mac"])
     return macs        

   def getLocatedPis(self,Locations):
     macs = []
     for x in Locations:
       query = "SELECT `Mac` FROM `Rp_Specs` WHERE HasCamera = 1";
       self.cursor.execute(query)
       results = self.cursor.fetchall()
       for y in results:
           macs.append(y["Mac"])
     
     return macs


   def addProcess(self, containerID , imgID , IPAddress , port, userID ,processName , mac):
     query =  "INSERT INTO `Process`(`Img_id`, `Process_name`, `Cont_id`, `Cont_IP`, `Mac`, `User_id`, `Process_State`, `port`, `result`) VALUES (\'"+imgID+"\',\'"+processName+"\',\'"+containerID+"\',\'"+IPAddress+"\',\'"+mac+"\',"+str(userID)+",22894,"+"\'"+port+"\',\'\')"
     try:
        self.cursor.execute(query)
        self.db.commit()
        self.incrementPi(mac)
        self.updateUserLog(userID,imgID,processName,22894)
     except Exception as e:
        print(e)

   def updateUserLog(self, userID,imgID,processName,state):
     query =  "UPDATE `User_Log` SET `Img_id`= \""+imgID+"\" , Action =  "+str(state)+" WHERE User_id = "+str(userID)+" AND Process_name = \""+processName+"\" ORDER BY Time DESC LIMIT 1"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)
      

   def updateResults(self, userID, processName, results):
     query = "UPDATE `Process` SET `result`=\'"+results+"\' WHERE Process_name = \'"+processName+"\' AND User_id = "+str(userID)+" ORDER BY Start_time DESC LIMIT 1"
     try:
        self.cursor.execute(query)
        self.db.commit()
        self.updateUserLog2(userID,processName)
     except Exception as e:
        print(e)
 
   def updateUserLog2(self, userID,processName):
     query =  "UPDATE `User_Log` SET  Action =  19195  WHERE User_id = "+str(userID)+" AND Process_name = \""+processName+"\" ORDER BY Time DESC LIMIT 1"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)  

  
   def shutPi(self, AdminID, mac ) :
     query =  "INSERT INTO `Admin_Log`(`Admin_id`, `Action`) VALUES ("+AdminID+",\'Closed Raspberry pi "+mac+" \')"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)
     query =  "UPDATE `Process` SET `Process_State`= 22198 WHERE Mac = \'"+mac+"\'"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

   def restartPi(self, AdminID, mac ) :
     query = "INSERT INTO `Admin_Log`(`Admin_id`, `Action`) VALUES ("+AdminID+",\'Restarted Raspberry pi "+mac+" \')"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)
     query =  "UPDATE `Process` SET `Process_State`=22198 WHERE Mac = \'"+mac+"\'"
     try:
        self.cursor.execute(query)
        self.db.commit()
     except Exception as e:
        print(e)

   def getSpecs(self, Mac):
     query2 = "SELECT Username , Password , PublicIP  FROM `Rp_Specs` WHERE Mac = \""+ Mac+" \""
     try:
       self.cursor.execute(query2)
       results = self.cursor.fetchall()
       for row  in results:
           result = row["Username"]
           result = result + ":"+row["Password"]
           result = result + ":"+row["PublicIP"]
       return result
     except Exception as e:
       print(e)

   def updateCurrentSpecs(self, Mac, PrivateIP, CPU_temp, CPU_usage, DISK_usage, RAM_usage):
      query = 'UPDATE Current_Specs SET PrivateIP = \''+ PrivateIP +'\', CpuUsage = %s, RamUsage = %s, FreeStorage = %s, Temperature = %s WHERE Mac = \''+Mac+'\''
      try:
         self.cursor.execute(query, [CPU_usage, RAM_usage, DISK_usage, CPU_temp])
         self.db.commit()
         print('updated')
      except Exception as e:
         self.db.rollback()
         print(e)

   def updateCriminalStatus(self, criminal):

        query = "UPDATE Criminals SET State = "+str(76767)+" WHERE Crim_id = \""+ str(criminal)+" \"   "
        try:
            self.cursor.execute(query)
            self.db.commit()
            print('updated')
        except Exception as e:
            self.db.rollback()
            print(e)