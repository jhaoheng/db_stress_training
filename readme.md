# 資料庫連線取資料效能

## 使用
- 連線方式
  - method_1 : 直接使用 phalcon mysql
  - method_2 : mysqli
  - method_3 : 新建 class, 在 class 中建立 phalcon mysql connection
  - method_4 : 透過 di 呼叫連線
- 壓測工具
  - ApacheBench : https://httpd.apache.org/docs/2.4/programs/ab.html
  - Vegeta : https://github.com/tsenart/vegeta
- 壓測內容 : 連線 db 與 `select * from users`, 測試四種不同方式, 速度上的差異
- 包裝 : docker 
  - mariadb
  - phalcon

# pre-required

- docker

# use
1. `docker-compose up -d`
2. check, 'http://localhost/info' will show phpinfo()
3. open `app/stress.php`, 確定使用哪種方式連線資料庫
4. 執行 
  - vegeta : `echo "GET http://127.0.0.1/stress" | vegeta attack -rate=300 -duration=10s | vegeta report`
  - apachebench : `ab -n 300 -c 20 -t 10 http://127.0.0.1/stress`