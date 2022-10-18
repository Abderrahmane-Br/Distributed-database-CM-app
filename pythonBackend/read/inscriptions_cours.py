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
    csr1.execute("SELECT etudiants.ID_Etudiant,etudiants.Nom , etudiants.Prenom , cours.Nom AS Nom_Cours,cours.ID_Cours From etudiants join inscription_cours on inscription_cours.ID_Etudiant=etudiants.ID_Etudiant inner join cours on inscription_cours.ID_Cours=cours.ID_Cours ORDER BY etudiants.ID_Etudiant")
    res1 = csr1.fetchall()
    cols1 = csr1.description
    dic1 = [] 

    for x in res1:
        sub = {}
        for i in range(len(x)):
            sub[cols1[i][0]] = x[i]
        dic1.append(sub)
    
    return dic1

def readdb2():
    db2 = mysql.connector.connect(
        host = "192.168.100.4",
        user = "Abderrahmen",
        password = "mysql10",
        database = "bdda"
    )

    csr2 = db2.cursor()
    csr2.execute("SELECT etudiants.ID_Etudiant,etudiants.Nom , etudiants.Prenom , cours.Nom AS Nom_Cours,cours.ID_Cours From etudiants join inscription_cours on inscription_cours.ID_Etudiant=etudiants.ID_Etudiant inner join cours on inscription_cours.ID_Cours=cours.ID_Cours ORDER BY etudiants.ID_Etudiant")
    res2 = csr2.fetchall()
    cols2 = csr2.description
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

