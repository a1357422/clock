$output_file = $args[0]
CD D:\wamp64\bin\mysql\mysql8.2.0\bin | cmd.exe /c "mysql -hlocalhost -u weibao -pweibao3361 clock < $output_file"