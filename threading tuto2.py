import concurrent.futures
import time

def fun(s):
    print(f"sleeping for {s}s")
    time.sleep(s)
    print("done!")
    return 5

with concurrent.futures.ThreadPoolExecutor() as excutor:
    t1 = excutor.submit(fun, 1.2)
    print(t1.result())