<template>
    <div class="container">
        <h1>Funkcijas</h1>
        <hr />

        <h4>delete user</h4>
        <p>DELIMITER ;;
            CREATE DEFINER=`root`@`localhost` FUNCTION `delete_user`(id int) RETURNS int
            DETERMINISTIC
            BEGIN
            DELETE users FROM users
            LEFT JOIN `address` ON users.AddressId = `address`.Id
            WHERE users.Id=id;
            RETURN 1;
            END ;;
            DELIMITER ;</p>
        <hr />

        <h4>edit_user user</h4>
        <p>DELIMITER ;;
            CREATE DEFINER=`root`@`localhost` FUNCTION `edit_user`(username varchar(255), email varchar(255),
            firstName VARCHAR(255),
            phone VARCHAR(45),
            lastName VARCHAR(255),roleId INT, address VARCHAR(255),
            city VARCHAR(255),countryId INT, userId INT) RETURNS int
            DETERMINISTIC
            BEGIN
            UPDATE users
            LEFT JOIN `address` a ON users.AddressId= a.Id
            LEFT JOIN country c ON a.CountryId = c.Id
            SET users.UserName=userName, users.Email=email,
            users.PhoneNumber=phone, users.FirstName=firstName, users.lastName = lastName, users.FullName=
            CONCAT(firstName, ' ', lastName),
            users.RoleId=roleId,
            a.Address=address, a.City=city, a.CountryId=countryId
            WHERE users.Id =userId;
            RETURN 1;
            END ;;
            DELIMITER ;</p>
        <hr />

        <h4>insert_new_user</h4>
        <p>DELIMITER ;;
            CREATE DEFINER=`root`@`localhost` FUNCTION `insert_new_user`(username varchar(255), email varchar(255),
            passwordHash LONGTEXT, firstName VARCHAR(255),
            phone VARCHAR(45),
            lastName VARCHAR(255),roleId INT, address VARCHAR(255),
            city VARCHAR(255),countryId INT ) RETURNS int
            DETERMINISTIC
            BEGIN
            INSERT INTO address(Address, City, CountryId)
            VALUES(address, city, countryId);
            INSERT INTO users(UserName, Email, PasswordHash, FirstName, LastName, FullName, RoleId, AddressId,
            PhoneNumber)
            VALUES(username, email, passwordHash, firstName, lastName, CONCAT(firstName, ',', lastName), roleId,
            LAST_INSERT_ID(), phone);
            RETURN 1;
            END ;;
            DELIMITER ;</p>
        <hr />

    </div>
</template>

<script>
    export default {

    }

</script>
