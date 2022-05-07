--Query 1
INSERT into clients ( clientFirstname, clientLastname, clientEmail, clientPassward, clientLevel, comment) 
Values ('Tony', 'Stark', 'tony@starkent.com', 'IamIronm@n', 1, 'I am the real Ironman');

--Query2
UPDATE clients SET clientLevel = 3 WHERE clientId = '1';

--Query3
UPDATE inventory
SET invDescription = REPLACE(invDescription,  'small interiors', 'spacious interior') 
WHERE invMake = 'GM' AND invModel = 'Hummer';

--Query4
SELECT i.invModel,  c.classificationName
FROM inventory i
INNER JOIN carclassification c ON i.classificationId = c.classificationId
WHERE c.classificationName = 'SUV';

--Query5
DELETE FROM inventory WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

--query6
UPDATE inventory
SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);