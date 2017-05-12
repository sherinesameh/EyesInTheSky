#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect("localhost","root","sherine","eits" )

# sql = "UPDATE Current_Specs SET .Mac, Rp_Specs.Generation, Rp_Specs.Location, Current_Specs.Temperature,Current_Specs.CpuUsage, Current_Specs.FreeStorage FROM Rp_Specs INNER JOIN Current_Specs on Rp_Specs.Mac = Current_Specs.Mac"
cursor = db.cursor()
sql = "SELECT * from Admin"

try:
    cursor.execute(sql)
    for row in cursor:
    #   db.commit()
      print(row)
except:
    db.rollback()
