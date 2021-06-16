<template>
    <div class="container">
        <h1>Triggeru veidosanas skripti</h1>
        <hr />
        <p>
            DELIMITER $$
            DROP TRIGGER IF EXISTS before_orderedproject_delete $$
            CREATE TRIGGER before_orderedproject_delete
            BEFORE DELETE
            ON unitedconstuctiongroup.orderedprojects FOR EACH ROW
            BEGIN
            DELETE FROM unitedconstuctiongroup.projectimages where ImageProjectId = OLD.Id;
            DELETE FROM unitedconstuctiongroup.projectdescription WHERE projectdescription.Id =
            OLD.ProjectDescriptionId;
            END;
        </p>

        <hr />
        <p>
            DELIMITER $$
            DROP TRIGGER IF EXISTS before_user_delete $$
            CREATE TRIGGER before_user_delete
            BEFORE DELETE
            ON unitedconstuctiongroup.users FOR EACH ROW
            BEGIN
            SET @customerId = (SELECT Id from customers WHERE customers.UserId = OLD.Id);
            IF @customerId IS NOT NULL THEN
            Update orderedprojects SET orderedprojects.IsArchived = 1 , orderedprojects.OrderedProjectCustomerId = null
            WHERE orderedprojects.OrderedProjectCustomerId = @customerId;
            END IF;
            DELETE FROM customers WHERE UserId = OLD.Id;
            END;
        </p>

        <hr />
        <p>
            DELIMITER $$
            DROP TRIGGER IF EXISTS before_user_delete $$
            CREATE TRIGGER before_user_delete
            BEFORE DELETE
            ON unitedconstuctiongroup.users FOR EACH ROW
            BEGIN
            DELETE FROM address WHERE address.Id = OLD.AddressId;
            SET @customerId = (SELECT Id from customers WHERE customers.UserId = OLD.Id);
            IF @customerId IS NOT NULL THEN
            Update orderedprojects SET orderedprojects.IsArchived = 1 , orderedprojects.OrderedProjectCustomerId = null;
            END IF;
            END;
        </p>

        <hr />
        <p>
            DELIMITER $$
            DROP TRIGGER IF EXISTS before_ordered_project_insert $$
            CREATE TRIGGER before_ordered_project_insert
            BEFORE INSERT
            ON unitedconstuctiongroup.orderedprojects FOR EACH ROW
            BEGIN
            IF NEW.Status IS NULL THEN SET NEW.Status = 1;
            END IF;
            SET NEW.IsArchived = 0;
            END;
        </p>

        <hr />
        <p>
            DELIMITER $$
            DROP TRIGGER IF EXISTS before_project_description_insert $$
            CREATE TRIGGER before_project_description_insert
            BEFORE INSERT
            ON unitedconstuctiongroup.projectdescription FOR EACH ROW
            BEGIN
            IF NEW.MoneySpent < 0 THEN SET NEW.MoneySpent=0; END IF; END; </p> </div> </template> <script>
                export default {

                }
                </script>
