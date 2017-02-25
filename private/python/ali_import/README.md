sudo apt-get install python
# install pip
sudo apt-get install python-pip python-dev build-essential 
sudo pip install --upgrade pip 
sudo pip install --upgrade virtualenv 

# create env
1 virtualenv -p python ali_import
  or 
  virtualenv -p python3 ali_import

# begin use env
1 source ali_import/bin/activate

# install packages
pip install requests

# done with the work
deactivate

# output packages
pip freeze > requirements.txt

# install requirements
pip install -r requirements.txt

