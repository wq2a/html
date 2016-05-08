all:	tmp
tmp:	system/tmp
	sudo chmod 777 system/tmp
	sudo chmod 777 uploads
	sudo chmod 777 uploads/alipay

generate:
	python private/python/alipay/alipay_plt.py

input:
	mv uploads/alipay/* private/python/alipay/data
	python3 private/python/alipay/a.py private/python/alipay/data/*.txt
	python private/python/alipay/alipay.py
	rm temp0.txt private/python/alipay/data/*.txt

# init database
initdb:
	tar xvf private/python/alipay/db.tar
	mysql -u root -p alipay < private/python/db/alipay.sql
	mysql -u root -p alipay < private/python/db/alipay_by_buyer.sql
	mysql -u root -p alipay < private/python/db/alipay_by_date.sql
	rm -r private/python/db

.PHONY:  tmp generate input initdb
