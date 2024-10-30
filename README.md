![AWS Architecture Diagram (1)](https://github.com/user-attachments/assets/aa8c5ad6-85c7-45aa-bef0-e39906bcc266)

## Key Architectural Highlights 

1.	Network and Security: Configured as a multi-AZ VPC for redundancy, with security groups controlling access at each layer.
o	Bastion Host: Acts as a secure gateway, with one PEM key dedicated to accessing the bastion host and another to securely SSH into the web server instances within the private subnet.
o	Application Load Balancer: Controls incoming traffic to the web servers, enabling automatic load balancing.
o	EC2 and RDS Security Groups: Separate rules control access to EC2 instances and the RDS MySQL database, enforcing network segmentation.
o	WAF is configured to filter traffic through the Application Load Balancer, blocking potentially malicious requests based on customizable rules. This helps ensure that the application remains resilient against common exploits, contributing to a secure environment for the e-commerce platform.

2.	Compute and Auto Scaling: EC2 instances run in an Auto Scaling Group, enabling the platform to dynamically scale based on traffic, behind an Application Load Balancer to manage traffic. Testing with Apache JMeter confirmed that the setup scales effectively under load, meeting demand during peak times without over-provisioning.

3.	CDN and Static Asset Management: A CloudFront CDN delivers static assets stored in S3, reducing latency and server load by offloading this content delivery to the CDN.

4.	Database Security: Amazon RDS MySQL with Multi-AZ configuration and enforced SSL for secure data-in-transit between the app and the database. SSL configurations have been verified for encryption.

5.	Automation and Secrets Management: The architecture uses pre-configured CloudFormaltion templates and AMIs, automated deployments, and AWS Secrets Manager for securely managing database credentials, with IAM roles providing the necessary permissions.
