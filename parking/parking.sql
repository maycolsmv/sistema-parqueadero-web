SELECT p.description, p.type_vehicle, p.piso,
 p.`space`, p.user_id , u.name, u.rol_id, u.parking_id FROM parqueaderos AS p , usuarios AS u
 WHERE u.rol_id = 1 AND u.parking_id = 1 and p.description = 'Parqueadero 1'  
 
 SELECT  p.type_vehicle, p.piso,
   p.`space`, p.user_id , u.name, p.description, u.rol_id, u.parking_id FROM parqueaderos AS p , usuarios AS u
WHERE u.rol_id = 1 AND u.parking_id = u.rol_id  and p.description = 'Parqueadero 2'