<template>
    <div class="container">
        <h1>Procedūru izveidosanas skripti</h1>
        <hr />

        <h4>izveidot jauno pabeigtu projektu</h4>
        <p>
            DELIMITER ;;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `create_new_finished_project`(address VARCHAR(255), city
            VARCHAR(255),
            text TEXT, finishDate DATE , startDate DATE, Title VARCHAR(255), employedCount INT,moneySpent FLOAT,
            mainImage VARCHAR(255) )
            BEGIN
            INSERT INTO projectdescription(Title, Text, Address, City, StartDate, FinishDate, EmployedCount, MoneySpent)
            VALUES(title,text, address, city, startDate, finishDate, employedCount, moneySpent );
            INSERT INTO orderedprojects(Status, ProjectDescriptionId) VALUES (4, LAST_INSERT_ID());
            INSERT INTO projectimages(ImageProjectId, ImagePath, IsMainImage) VALUES (LAST_INSERT_ID(), mainImage, 1);
            END ;;
            DELIMITER ;
        </p>
        <hr />

        <h4>panemt pabeigtu projektu bildes</h4>
        <p>
            DELIMITER ;;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `get_finished_projects_with_images`()
            BEGIN
            SELECT p.Id,
            (SELECT TIMESTAMPDIFF(MONTH, (SELECT d.StartDate), (SELECT d.FinishDate))) AS TimeSpent,
            d.Address, p.Status, d.EmployedCount, d.Text, d.Title,d.City, pi.ImagePath
            FROM orderedprojects p, projectdescription d, projectimages pi
            WHERE p.ProjectDescriptionId = d.Id
            AND p.Status = 4
            AND pi.ImageProjectId = p.Id;
            END ;;
            DELIMITER ;
        </p>
        <hr />

        <h4>panemt projektus, kuru status ir in progress</h4>
        <p>
            DELIMITER ;;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `get_projects_in_progress`(projectInProgressStatusValue int)
            BEGIN
            SELECT orderedprojects.Id, projectdescription.Address, projectdescription.City, users.FullName
            from customers, users, orderedprojects
            INNER JOIN projectdescription ON projectdescription.Id = orderedprojects.ProjectDescriptionId
            WHERE orderedprojects.Status = projectInProgressStatusValue
            AND orderedprojects.OrderedProjectCustomerId = customers.Id
            AND customers.UserId = users.Id;
            END ;;
            DELIMITER ;
        </p>
        <hr />

        <h4>get_user_to_preview</h4>
        <p>
            DELIMITER ;;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_to_preview`(userId int)
            BEGIN
            SELECT u.Id, u.UserName, u.Email, u.RoleId, u.PhoneNumber, u.FirstName, u.LastName, a.Address, a.City,
            c.Name, c.Code, a.CountryId FROM users u
            left JOIN `address` a ON u.AddressId = a.Id
            left JOIN country c ON a.CountryId = c.Id
            WHERE u.Id =userId;
            END ;;
            DELIMITER ;
        </p>
        <hr />

    </div>
</template>

<script>
    export default {

    }

</script>
