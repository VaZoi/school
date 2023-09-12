use world;

SELECT city.name, city.population, country.name
FROM city
INNER JOIN country
ON city.CountryCode = country.code;

SELECT city.name, city.district, country.continent, country.population
FROM city
INNER JOIN country
ON city.CountryCode = country.code;

SELECT countrylanguage.language, country.population, country.lifeexpectancy
FROM countrylanguage
INNER JOIN country
ON countrylanguage.language = country.code;

SELECT countrylanguage.language, country.population, country.lifeexpectancy
FROM countrylanguage
INNER JOIN country
ON countrylanguage.language = country.code where country.Population >1000000;

SELECT countrylanguage.language, country.name
FROM countrylanguage
INNER JOIN country
ON countrylanguage.language = country.code WHERE countrylanguage.percentage BETWEEN 50 AND 90;
