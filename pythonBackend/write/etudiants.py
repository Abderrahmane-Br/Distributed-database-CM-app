#!D:\Programs\Windows\Python\Python310\python.exe
import sys
import concurrent.futures
import mysql.connector

query = sys.argv[1]
def writedb1():
    db1 = mysql.connector.connect(
        host = "localhost",
        user = "root",
        password = "mysql10",
        database = "bdda"
    )

    csr1 = db1.cursor()
    csr1.execute(query)

def writedb2():
    db2 = mysql.connector.connect(
        host = "localhost",
        user = "Abderrahmen",
        password = "mysql10",
        database = "bdda"
    )

    csr2 = db2.cursor()
    csr2.execute(query)


with concurrent.futures.ThreadPoolExecutor() as excutor:
    t1 = excutor.submit(writedb1)
    t2 = excutor.submit(writedb2)
print(query)

