#!/bin/bash

# --------------------------------------------------
# PATHS AND CREDENTIALS CONFIG
# --------------------------------------------------

# ssh user
USER="euquister"
# ssh host
HOST="ssh.uhserver.com"
# project target dir
PDIR="appaloosabooks.com/web"

# mysql ap books user
APDBUSER="toadminap"
# mysql ap books pass
APDBPASS="Trufasazuis87@"
# mysql ap books host
APDBHOST="appaloosa.mysql.uhserver.com"
# my sql ap books database name
APDBDATA="appaloosa"

# mysql ap magazine user
MGDBUSER="toadminapmag"
# mysql ap magazine pass
MGDBPASS="Trufasazuis87@"
# mysql ap magazine host
MGDBHOST="appaloosa.mysql.uhserver.com"
# my sql ap magazine database name
MGDBDATA="appaloosa_mag"

# mysql ap matomo user
MTDBUSER="apmatomo"
# mysql ap matomo pass
MTDBPASS="Trufasazuis87@"
# mysql ap matomo host
MTDBHOST="ap-matomo.mysql.uhserver.com"
# my sql ap matomo database name
MTDBDATA="ap_matomo"

# --------------------------------------------------
# CREATE BOOKS & MAGAZINE DB DUMPS
# --------------------------------------------------

# ap db // core
/Applications/AMPPS/mysql/bin/mysqldump -u$APDBUSER -p$APDBPASS -h$APDBHOST $APDBDATA > ./config/dumps/ap_bks_dump.sql

# ap mag // magazine
/Applications/AMPPS/mysql/bin/mysqldump -u$MGDBUSER -p$MGDBPASS -h$MGDBHOST $MGDBDATA > ./config/dumps/ap_mag_dump.sql

# ap matomo // analytics
/Applications/AMPPS/mysql/bin/mysqldump -u$MTDBUSER -p$MTDBPASS -h$MTDBHOST $MTDBDATA > ./config/dumps/ap_mtm_dump.sql

# --------------------------------------------------
# SYNC APPALOOSA BOOKS UPLOAD FOLDERS
# --------------------------------------------------

scp -r "$USER@$HOST:$PDIR/webroot/freestore/*" ./webroot/freestore

scp -r "$USER@$HOST:$PDIR/webroot/admin_root/img/ups/*" ./webroot/admin_root/img/ups/

# --------------------------------------------------
# SYNC APPALOOSA MAGAZINE
# --------------------------------------------------

scp -r "$USER@$HOST:$PDIR/webroot/magazine/wp-content/uploads/*" ./webroot/magazine/wp-content/uploads/

