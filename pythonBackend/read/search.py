#!D:\Programs\Windows\Python\Python310\python.exe
import sys
import json
import concurrent.futures
import mysql.connector
query = ""
for i in range(1, len(sys.argv)):
    query += ' ' + str(sys.argv[i]) + ' '


def readdb1():
    db1 = mysql.connector.connect(
        host="localhost",
        user="root",
        password="mysql10",
        database="bdda1"
    )

    csr1 = db1.cursor()
    csr1.execute(query)
    res1 = csr1.fetchall()
    cols1 = csr1.description
    # print("res 1 " +str(res1))
    dic1 = []
    for x in res1:
        sub = {}
        for i in range(len(x)):
            sub[cols1[i][0]] = x[i]
        dic1.append(sub)
    return dic1


def readdb2():
    db2 = mysql.connector.connect(
        host="localhost",
        user="root",
        password="mysql10",
        database="bdda2"
    )

    csr2 = db2.cursor()
    csr2.execute(query)
    res2 = csr2.fetchall()
    cols2 = csr2.description
    # print("res 2 " +str(res2))
    dic2 = []

    for x in res2:
        sub = {}
        for i in range(len(x)):
            sub[cols2[i][0]] = x[i]
        dic2.append(sub)
    return dic2


with concurrent.futures.ThreadPoolExecutor() as excutor:
    t1 = excutor.submit(readdb1)
    t2 = excutor.submit(readdb2)
    print(json.dumps(t1.result()+t2.result()))
