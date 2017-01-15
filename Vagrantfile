Vagrant.configure("2") do |config|
  config.vm.network :forwarded_port, guest: 80, host: 8080
  config.vm.network :forwarded_port, guest: 8000, host: 8000
  config.vm.network "private_network", ip: "192.168.33.102"
  config.vm.synced_folder "./", "/web/"
end

Vagrant::Config.run do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.box_url = "https://atlas.hashicorp.com/ubuntu/boxes/xenial64"
  config.vm.provision :shell, :path => "vagrant-setup/php.sh"
  config.vm.provision :shell, :path => "vagrant-setup/mysql.sh"
end
