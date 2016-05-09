all:	tmp
tmp:	system/tmp
	sudo chmod 777 system/tmp
	sudo chmod 777 uploads
	sudo chmod 777 uploads/alipay

generate:
	python private/python/alipay/alipay_plt.py

ios:
	# xcrun instruments -w B63AA68B-3912-43FC-B644-7E2CEBFF038D
	xcrun simctl list

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

.PHONY:  tmp generate ios input initdb
