### Setup
- Create, provision and start VM
```bash
vagrant up
```

### Web access (haproxy frontend)
URL : http://localhost:8089

### HAProxy Stats
- First you need to create an SSH tunnel though the VM
```bash
ssh -L 9000:localhost:9000 vagrant@localhost -p 2222 -i ./.vagrant/machines/default/virtualbox/private_key
```
- Then go to http://localhost:9000