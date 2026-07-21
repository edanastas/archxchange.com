import os, sys

base = r"C:\Users\eanastas\Documents\_REPOS\archxchange.com"
fail = 0

# config.php: relative path, no absolute
with open(os.path.join(base, "config.php")) as f:
    c = f.read()
if '../secure/archxchange.com/' in c:
    print("OK: config.php uses relative ../secure/archxchange.com/")
else:
    print("FAIL: config.php missing relative path")
    fail += 1
if '/www/domains/secure' not in c:
    print("OK: config.php has no absolute secure path")
else:
    print("FAIL: config.php still has absolute secure path")
    fail += 1

# config_global.php: dirname(__FILE__) for db.php
with open(os.path.join(base, "secure", "config_global.php")) as f:
    c = f.read()
if 'dirname(__FILE__) . "/db.php"' in c:
    print("OK: config_global.php uses dirname(__FILE__) for db.php")
else:
    print("FAIL: config_global.php missing dirname(__FILE__)")
    fail += 1
if '/www/domains/secure' not in c:
    print("OK: config_global.php has no absolute path")
else:
    print("FAIL: config_global.php still has absolute path")
    fail += 1

print(f"\n{fail} failures")
sys.exit(fail)
