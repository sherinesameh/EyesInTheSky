
from dbHandler import dbHandler


db = dbHandler()
mac = db.getMac()
target = db.getSpecs(mac)
results = target.split(":")
print(results)

username = results[0]
password = results[1]
hostname = results[2]