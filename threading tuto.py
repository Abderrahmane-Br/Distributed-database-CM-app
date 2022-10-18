from re import T
import threading
import time

start = time.perf_counter()

def fun(s):
    print(f"sleeping for {s}s")
    time.sleep(s)
    print("done!")
    return 5

t1 = threading.Thread(target=fun, args=[1.8])
t2 = threading.Thread(target=fun, args=[1.8])

t1.start()
t2.start()

print(t1.join())
t2.join()

finish = time.perf_counter()
print(f'done in {round(finish - start, 2)}')