# Custom short URLs

## Installation (production)

### Create non-root User

1. Create user and set his password
```
sudo adduser laravel --disabled-password
```

2. Add root privileges for user
```
sudo usermod -aG sudo laravel
```

3. Copy access key to laravel .ssh directory
```
sudo mkdir /home/laravel/.ssh
sudo chown laravel:laravel /home/laravel/.ssh
sudo cp .ssh/authorized_keys /home/laravel/.ssh/authorized_keys
sudo chown laravel:laravel /home/laravel/.ssh/authorized_keys
```

4. Remove password prompt for laravel user (add at the end of file)
```
sudo visudo
----
laravel ALL=(ALL) NOPASSWD: ALL
```

5. Login as laravel user and edit (add at the top):
```
nano ~/.bashrc
----
cd ~/custom-short-URLs/
export LC_ALL="en_US.UTF-8"
export LC_CTYPE="en_US.UTF-8"
```

6. Change DNS servers to Google 
```
sudo sed -i -r 's/dns-nameservers[\ 0-9\.]+/dns-nameservers 8.8.8.8 8.8.4.4/g' /etc/network/interfaces.d/50-cloud-init.cfg
```

### Add swap file

1. Create a 4 Gigabyte file, enabling the swap file, set up the swap space
```
sudo fallocate -l 4G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
```

2. Make the swap file permanent (add at the end of file)
```
sudo nano /etc/fstab
----
/swapfile   none    swap    sw    0   0
```

3. Tweak your swap settings
```
sudo sysctl vm.swappiness=10
sudo sysctl vm.vfs_cache_pressure=50
```

4. Make changes permanent (add at the end of file)
```
sudo nano /etc/sysctl.conf
----
vm.swappiness=10
vm.vfs_cache_pressure = 50
```

### Install Docker and Docker-compose

1. Update packages database
```
sudo apt update
```

2. Add GPG key from official docker repository and add docker repository
```
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"
```

3. Update packages database
```
sudo apt update
```

4. Install docker
```
sudo apt install docker-ce
```

5. Add current user to docker group
```
sudo usermod -aG docker ${USER}
```

6. Restart ssh session & login as laravel

7. Download docker compose
```
sudo curl -L https://github.com/docker/compose/releases/download/1.28.6/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
```

8. Next we'll set the permissions
```
sudo chmod +x /usr/local/bin/docker-compose
```

### Clone this repository

1. Clone repository
```
git clone https://github.com/andrew-narolsky/custom-short-URLs.git
```

### Configure laravel and docker

1. Copy laravel `html/.env.example` file to `html/.env` and change it's variables
```
cp html/.env.example html/.env
```

2. Copy docker `docker/.env.example` to `docker/.env` and change it's variables
```
cp docker/.env.example docker/.env
```

3. Start docker containers
```
cd ~/custom-short-URLs/docker
make build
```

### Init laravel

1. Enter workspace container
```
cd /home/laravel/custom-short-URLs/docker/ 
make exec
```

2. Install composer and nmp packages
```
cd html
composer install
npm install
```

3. Compile css and js files
```
npm run production
```

4. Generate jwt secret
```
php artisan jwt:secret
```

5. Create database
```
php artisan migrate --seed
```

6. Login to admin page as user `qwerty@i.ua` with password `password`