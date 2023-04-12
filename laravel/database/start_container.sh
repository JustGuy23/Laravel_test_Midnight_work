docker run --detach --name=mysql --env="MYSQL_ROOT_PASSWORD=password"  --publish 3306:3306  --volume=database/docker_mysql_cfg/conf.d:/etc/mysql/conf.d  mysql
