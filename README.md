# welcome-service

Automated web server management using Ansible roles and configured a PostgreSQL database utilizing the JSONB data type to output results in JSON format.

The system should respond to port 80 and deliver content from a database via HTTP. The
content should contain a simple text message "Welcome to your new test system!" read
from the database.

Specs:
LAMP system with Rocky Linux


Further recommendations for potential improvements include:
 - Enforcing requests over SSL
 - Implementing an API gateway
 - Applying rate limiting
 - Using ACLs
 - Extending the API to full CRUD functionality
 - Adding Swagger/OpenAPI documentation