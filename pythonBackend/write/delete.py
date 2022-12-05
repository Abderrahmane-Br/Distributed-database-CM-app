#!D:\Programs\Windows\Python\Python310\python.exe
import sys
import concurrent.futures
import mysql.connector

query = ""
for i in range(1, len(sys.argv)):
    query = query + ' ' + str(sys.argv[i])+' '
print(query)


def writedb1():
    db1 = mysql.connector.connect(
        host="localhost",
        user="root",
        password="mysql10",
        database="bdda1"
    )

    csr1 = db1.cursor()
    csr1.execute(query)
    db1.commit()


def writedb2():
    db2 = mysql.connector.connect(
        host="localhost",
        user="root",
        password="mysql10",
        database="bdda2"
    )

    csr2 = db2.cursor()
    csr2.execute(query)
    db2.commit()


with concurrent.futures.ThreadPoolExecutor() as excutor:
    t1 = excutor.submit(writedb1)
    t2 = excutor.submit(writedb2)
    # print(t1.result())
