# College Online Admission System

# Administrator Default User / Password
* User: admin@admin.admin
* Password: admin@123

# Required
* PHP 7 or above
* domain name and hosting server

The landing page is as follow:
![16](https://user-images.githubusercontent.com/20646204/183823542-2351a6b9-5b03-4dc6-9fe7-ae5d7f3c3e69.PNG)

Students can apply admission online by filling up the application.
![17](https://user-images.githubusercontent.com/20646204/183823606-649ceaf2-cc49-4a34-b287-628bd7354e9b.PNG)

The duely filled application will be monitored by the administrative staff, where the submitted application will be verified or validated with marks, and other criteria setup therein. Then, if found intact, the application will be keep for further verification. The step 2 verification will be taken care by the principal, where he/she will approve the application for each candidate (may be base on merit list). Once the application for the student is approved for admission, the student will get notification on their email, and also SMS message on their mobile phone. To finalise the admission, the students (approved) will then see admission payment link with their application ID when login. The fee can be paid Online or Offline. Once the fee is paid, then the admission confirmation will be sent to the student on his/her email, also on his/her mobile phone using SMS.

In the landing page, student can chat with the staff. Tawk.to is support currently. All we need to do is just feed the api key in the admin dashboard.

The student login will look likes:
![18](https://user-images.githubusercontent.com/20646204/183824338-f8c366c4-c50c-4bd4-b63d-73181065bdb6.PNG)

Each applicant will get unique application id when the application is submitted. The default password will be the student date of birth in the format of DDMMYYYY.

The administrator, principal can verify the payment, application from the admin dashboard.

![2](https://user-images.githubusercontent.com/20646204/183824514-58c1d60f-f4d8-407e-8880-9b9371bceaa1.PNG)

Number of applicants, approved students for admission, admitted students, fee payment total, etc can be send on the dashboard. Further details can be seen by clicking the cards or from the menu list.

![3](https://user-images.githubusercontent.com/20646204/183824648-487c6640-d2d0-4f23-9388-19d1bdde09b5.PNG)

![4](https://user-images.githubusercontent.com/20646204/183824667-6bd17372-4d7e-456c-af2e-2a40fb3d0053.PNG)

![5](https://user-images.githubusercontent.com/20646204/183824682-7b8701f4-5514-4dbb-bd99-64fbd383155b.PNG)

![6](https://user-images.githubusercontent.com/20646204/183824700-01d806e8-ef9a-45fb-bec0-c3043092da9e.PNG)

![10](https://user-images.githubusercontent.com/20646204/183824863-7b3c051e-72d1-4d7a-a5c2-93dce9c6c9df.PNG)

Adding users, changing the college details, payment gateway, sms api key, etc need to be done from the setting option.

![8](https://user-images.githubusercontent.com/20646204/183824799-37217aa0-af82-4686-96dc-caca7481a7af.PNG)

![11](https://user-images.githubusercontent.com/20646204/183824867-00983ac9-e7d5-4292-8c1b-d69dbbcebbfe.PNG)

![9](https://user-images.githubusercontent.com/20646204/183824864-37717765-dfdb-419b-9c98-ac6ecf0fbb40.PNG)

![12](https://user-images.githubusercontent.com/20646204/183824898-86bb161b-104a-442d-b315-99d9d6176ac1.PNG)

![13](https://user-images.githubusercontent.com/20646204/183824912-7220c2aa-fdb8-4c11-98e8-9ede72eb02f3.PNG)

![14](https://user-images.githubusercontent.com/20646204/183824916-c2fa123e-ec62-4401-87c9-a358c180a769.PNG)

![15](https://user-images.githubusercontent.com/20646204/183824937-409bb6e3-6c11-40c4-b7d4-1a268525fe7a.PNG)

Currently, only RazorPay payment gateway is supported.
For SMS Gateway, MSG91 is supported.
For Email Gateway, sendgrid and sendinblue are supported.

You can evaluate it, and let me know if there is anything to be fixed.
