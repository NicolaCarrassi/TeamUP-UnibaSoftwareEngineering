use teamup_fullstackexception;

insert into competences(`competence`)
values
	('Centro (Basket)'),
	('Playmaker (Basket)'),
	('Guardia (Basket)'),
	('Ala grande (Basket)'),
	('Ala piccola (Basket)'),
	('Palleggiatore (Volley)'),
	('Centrale (Volley)'),
	('Schiacciatore-laterale (Volley)'),
	('Schiacciatore-opposto (Volley)'),
	('Libero (Volley)'),
	('Tennista'),
	('Nuotatore'),
	('Portiere (Calcio) '),
	('Difensore centrale (Calcio) '),
	('Terzino destro (Calcio) '),
	('Terzino sinistro (Calcio) '),
	('Mediano (Calcio)'),
	('Esterno centrocampo (Calcio) '),
	('Ala destra (Calcio) '),
	('Ala destra (Calcio)'),
	('Mezzala (Calcio)'),
	('Trequartista (Calcio) '),
	('Centravanti (Calcio)'),
	('Seconda Punta (Calcio)'),
	('Yoga'),
	('Zumba'),
	('Pilates'),
	('Golf'),
	('Karate'),
	('Portiere (Calcio a 5)'),
	('Centrale (Calcio a 5)'),
	('Intermedio (Calcio a 5)'),
	('Pivot (Calcio a 5)'),
	('Pilone sinistro (Rugby)'),
	('Tallonatore (Rugby)'),
	('Pilone destro (Rugby)'),
	('Seconda linea (Rugby)'),
	('Flanker destro (Rugby)'),
	('Flanker sinistro (Rugby)'),
	('Terza linea centro (Rugby)'),
	('Mediano di mischia (Rugby)'),
	('Mediano di apertura'),
	('Tre quarti ala chiusa sinistro (Rugby)'),
	('Centro interno (Rugby)'),
	('Centro esterno (Rugby)'),
	('Tre quarti ala aperta destro (Rugby)'),
	('Estremo (Rugby)'),
 	('Fullstack developer'),
	('Front end devoloper'),
	('Back-end developer'),
	('Database administrator'),
	('Java'),
	('C++'),
	('Pacchetto office'),
	('Riparazione iphone'),
	('Riparazione telefoni'),
	('Sistemista (informatica)'),
	('Fisica'),
	('Chimica'),
	('Biologia'),
	('Fagottista'),
	('Cantante'),
	('Chitarrista'),
	('Bassista'),
	('Violinista'),
	('Batterista'),
	('Arpista'),
	('Violoncellista'),
	('Flautista'),
	('Rapper'),
	('Producer'),
	('Dj'),
	('Pianista'),
	('Cantante Lirico'),
	('VideoMaker'),
	('Fotografo'),
	('Regista'),
	('Sceneggiatore'),
	('Tecnico luci'),
	('Tecnico audio'),
	('Photoshop');
	

update competences set verified=1;

insert into categories (Category)
values
	('Sport e Fitness'),	
	('Tecnologia'),	
	('Musica'),	
	('Foto e Video');	

insert into cities(City)
values
                ('Asti'),
                ('Avellino'),
                ('Bari'),
                ('Bergamo'),
                ('Belluno'),
                ('Benevento'),
                ('Biella'),
                ('Bologna'),
                ('Bolzano'),
                ('Brescia'),
                ('Brindisi'),
                ('Cagliari'),
                ('Caltanissetta'),
                ('Carbonia-Iglesias'),
                ('Caserta'),
                ('Catania'),
                ('Campobasso'),
                ('Chieti'),
                ('Como'),
                ('Cosenza'),
                ('Cremona'),
                ('Crotone'),
                ('Catanzaro'),
                ('Cuneo'),
                ('Enna'),
                ('Ferrara'),
                ('Firenze'),
                ('Forli-Cesena'),
                ('Foggia'),
                ('Frosinone'),
                ('Genova'),
                ('Gorizia'),
                ('Grosseto'),
                ('Imperia'),
                ('Isernia'),
                ('La Spezia'),
                ('Latina'),
                ('Lecco'),
                ('Lecce'),
                ('Livorno'),
                ('Lodi'),
                ('Lucca'),
                ('Matera'),
                ('Macerata'),
                ('Mantova'),
                ('Massa-Carrara'),
                ('Medio Campidano'),
                ('Messina'),
                ('Milano'),
                ('Modena'),
                ('Napoli'),
                ('Novara'),
                ('Nuoro'),
                ('Ogliastra'),
                ('Olbia-Tempio'),
                ('Oristano'),
                ('Parma'),
                ('Palermo'),
                ('Pavia'),
                ('Padova'),
                ('Perugia'),
                ('Pesaro e Urbino'),
                ('Piacenza'),
                ('Pisa'),
                ('Pistoia'),
                ('Pordenone'),
                ('Prato'),
                ('Pescara'),
                ('Potenza'),
                ('Ragusa'),
                ('Ravenna'),
                ('Reggio Emilia'),
                ('Reggio Calabria'),
                ('Rieti'),
                ('Rimini'),
                ('Roma'),
                ('Rovigo'),
                ('Salerno'),
                ('Sassari'),
                ('Savona'),
                ('Siena'),
                ('Siracusa'),
                ('Sondrio'),
                ('Taranto'),
                ('Teramo'),
                ('Torino'),
                ('Trapani'),
                ('Trento'),
                ('Trieste'),
                ('Terni'),
                ('Treviso'),
                ('Udine'),
                ('Varese'),
                ('Verbano Cusio Ossola'),
                ('Venezia'),
                ('Vercelli'),
                ('Vicenza'),
                ('Viterbo'),
                ('Vibo Valentia'),
                ('Verona');


 insert into admins values (1, 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', null, null);