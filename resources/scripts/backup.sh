#/bin/sh

#$1 - db user (root)
#$2 - db pass (********)
#$3 - db name (app)
#$4 - app path (/var/www/app)
#$5 - email (email@example.com)







#1 variables
created_at=`date +%Y.%m.%d_%H.%M.%S`
temp_sql=/tmp/${created_at}_$3.sql
temp_sql_tar=/tmp/${created_at}_$3.sql.tar.gz



mysqldump --user=$1 --password=$2 --database=$3 > $temp_sql
tar -czf $temp_sql $temp_sql_tar 2>/dev/null
echo 'See attached file' | nail -s "$3 backup" -a $temp_sql_tar -r $5

echo 5/$STEPS. cleaning...
        find /var/www/glpi/files/_dumps/ -type f -mmin +720 -exec rm -f {} \;
        find /var/www/glpi/files/_dumps/*.tar.gz -type f -exec rm -f {} \;




#2 get all usb devices and save all to db
devices=$(ls -la /dev/serial/by-path/ | grep pci* | awk '{ print $9 " " $11 }')
mysql --user=$1 --password=$2 --database=$3 --silent << EOF
UPDATE gateways SET devices='$devices' where id='1';
EOF



#3 generate
if [ -f $4 ]
then
cp $4 /etc/kannel/kannel.conf -f --remove-destination
rm -rf $4
killall bearerbox -q >> /dev/null
killall bearerbox -q >> /dev/null
killall bearerbox -q >> /dev/null
killall bearerbox -q >> /dev/null
killall bearerbox -q >> /dev/null
killall bearerbox -q >> /dev/null
/usr/sbin/service kannel restart
fi




exit 0