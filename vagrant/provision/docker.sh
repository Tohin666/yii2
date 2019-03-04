wget -qO- https://get.docker.com/ | sh
usermod -aG docker vagrant
sudo apt-get -y install python-pip
sudo pip install docker-compose