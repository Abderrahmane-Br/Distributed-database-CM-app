#!D:\Programs\Windows\Python\Python310\python.exe

import json
import concurrent.futures
import mysql.connector

def readdb1():
    db1 = mysql.connector.connect(
        host = "localhost",
        user = "root",
        password = "mysql10",
        database = "bdda"
    )

    csr1 = db1.cursor()
    csr1.execute("SELECT * FROM cours")
    res1 = csr1.fetchall()
    
    return len(res1)

def readdb2():
    db2 = mysql.connector.connect(
        host = "192.168.100.4",
        user = "Abderrahmen",
        password = "mysql10",
        database = "bdda"
    )

    csr2 = db2.cursor()
    csr2.execute("SELECT * FROM cours")
    res2 = csr2.fetchall()
    
    return len(res2)

with concurrent.futures.ThreadPoolExecutor() as excutor:
    t1 = excutor.submit(readdb1)
    t2 = excutor.submit(readdb2)
    print((t1.result()+t2.result()))

