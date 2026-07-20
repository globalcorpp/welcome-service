rocky linux 10 Generic Cloud-Base

sudo apt install virt-manager
sudo apt install virtinst libguestfs-tools virt-top bridge-utils

sudo virt-sysprep -a Rocky-10-GenericCloud-Base.latest.x86_64.qcow2 --run-command 'useradd saeed' --run-command 'usermod -aG wheel saeed' --run-command 'echo "a@1234" | passwd --stdin saeed ' --selinux-relabel

virsh net-list 
virsh net-dhcp-leases default

ssh-keygen -t rsa -b 4096 -C "gd"
ssh-copy-id user@target_server_ip

ssh-copy-id -i /path/to/your/custom_key.pub user@target_server_ip
ssh -i /path/to/your/custom_key.pub user@target_server_ip

// Ed25519
ssh-keygen -t ed25519 -C "saeed-personal-laptop"
// Key fingerprint
ssh-keygen -lf ~/.ssh/authorized_keys

chmod 600 /app/gd/gd

ansible all -m ping -k

psql -h localhost -p 5432 -U postgres
\l
\c gd_db
SELECT * FROM gd_data;
sudo -u postgres psql -d gd_db -c "TRUNCATE gd_data RESTART IDENTITY;"
sudo -u postgres psql -d gd_db -c "DROP TABLE gd_data;"

https://192.168.122.48:9090/
http://192.168.122.48/get_data.php?id=1


ansible-playbook site.yml -K --private-key /app/gd/gd
