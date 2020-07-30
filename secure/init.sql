BEGIN TRANSACTION;

CREATE TABLE `users` (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	username TEXT NOT NULL UNIQUE,
	password TEXT NOT NULL
);

CREATE TABLE `sessions` (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	user_id INTEGER NOT NULL,
	session TEXT NOT NULL UNIQUE
);

CREATE TABLE `contact` (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	name TEXT NOT NULL,
	email TEXT NOT NULL,
	reason TEXT NOT NULL,
	text TEXT NOT NULL,
	delivery TEXT NOT NULL
);

CREATE TABLE `menu`
(
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`menu_name` TEXT NOT NULL,
	`description` TEXT,
    `price` INTEGER,
	`category_id` INTEGER NOT NULL
);

CREATE TABLE `categories`
(
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`category` TEXT NOT NULL UNIQUE
);

CREATE TABLE `diets`
(
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`diet` TEXT NOT NULL UNIQUE
);

CREATE TABLE `diet_tags`
(
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`menu_id` INTEGER NOT NULL,
	`diet_id` INTEGER NOT NULL
);

CREATE TABLE `images`
(
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`menu_id` INTEGER,
	`image_name` TEXT,
  `image_ext` TEXT NOT NULL,
  `description` TEXT,
	`source` TEXT,
  `review_id` INTEGER
);

CREATE TABLE `reviews`
(
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`reviewer` TEXT NOT NULL,
	`date` TEXT NOT NULL,
  `email` TEXT,
	`rating` INTEGER NOT NULL,
	`review_title` TEXT,
  `comment` TEXT
);

-- USERS SEED DATA
INSERT INTO users (id, username, password)
VALUES (1, 'ec23', '$2y$10$sBphaM4LM8le9DDE4gdxguSrBxiRU9qi0yrBXhIA4lLDm48M3yqh2'); -- password: test
INSERT INTO users (id, username, password)
VALUES (2, 'abc123', '$2y$10$sBphaM4LM8le9DDE4gdxguSrBxiRU9qi0yrBXhIA4lLDm48M3yqh2'); -- password: test

-- CONTACT SEED DATA
INSERT INTO `contact` (id, name, email, reason, text, delivery)
VALUES (1, "Emily", "ec23@cornell.edu", "Request More Information", "Do you still serve that Kimchi dish?", "Grubhub");
INSERT INTO `contact` (id, name, email, reason, text, delivery)
VALUES (2, "John", "se82@cornell.edu", "Make A Reservation", "Birthday Party coming up", "IthacaToGo");
INSERT INTO `contact` (id, name, email, reason, text, delivery)
VALUES (3, "Simon", "sf15@cornell.edu", "Other", "Are you closed for the holidays?", "DeliverIthaca");

-- REVIEWS SEED DATA
INSERT INTO `reviews` (id, reviewer, date, email, rating, review_title, comment)
VALUES (1, "Kaitlyn", "2019-04-27", "kml284@cornell.edu", 4, "Really Great Food", "I loved the seafood");
INSERT INTO `reviews` (id, reviewer, date, email, rating, review_title, comment)
VALUES (2, "Kaitlyn2", "2018-04-27", "kml284@cornell.edu", 1, "Yuck", "I don't like korean food");
INSERT INTO `reviews` (id, reviewer, date, email, rating, review_title, comment)
VALUES (3, "Kaitlyn3", "2019-03-27", "kml284@cornell.edu", 3, "Decent Food", "It was just okay");
INSERT INTO `reviews` (id, reviewer, date, email, rating, review_title, comment)
VALUES (4, "Kaitlyn", "2017-06-27", "kml284@cornell.edu", 5, "AMAZING", "Went there for lunch with friends and really enjoyed the food");
INSERT INTO `reviews` (id, reviewer, date, email, rating, review_title, comment)
VALUES(5, "Jamie", "2019-05-01", "jamie@gmail.com", 5, "Good Service", "They gave us free sikhye when we went!!! awesome service!!!!");

-- MENU SEED DATA
-- appetizers
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (1, "Mandoo (만두)", "Steamed or fried dumplings available in beef or vegetable", 4.99, 1);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (2, "Pa Jun (파전)", "Lightly pan-fried wheat batter with scallions", 5.99, 1);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (3, "Kimchi Pa Jun (김치파전)", "Lightly pan-fried wheat batter with kimchi", 6.99, 1);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (4, "Hae Mul Pa Jun (해물파전)", "Lightly pan-fried wheat batter with mixed seafood and scallions", 6.99, 1);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (5, "Dukk Bokki (떡복이)", "Rice cakes with vegetables in spicy bean paste sauce", 5.99, 1);
-- salads
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (6, "House Salad (하우스샐러드)", "Lettuce and sesame with special dressing", 4.99, 2);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (7, "Seafood Salad (해물샐러드)", "House salad with mixed seafood", 6.99, 2);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (8, "Tofu Salad (두부샐러드)", "House salad with tofu", 5.99, 2);
-- broiled fish
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (9, "Godeunguh Gui (고등어구이)", "Specially broiled mackerel", 10.99, 3);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (10, "Salmon Gui (연어구이)", "Specially grilled salmon", 15.99, 3);
-- teriyaki
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (11, "Salmon Teriyaki (연어데리야끼)", "Broiled fresh salmon glazed with sweet teriyaki sauce", 15.99, 4);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (12, "Chicken Teriyaki (치킨데리야끼)", "Broiled tender chicken glazed with sweet teriyaki sauce", 13.99, 4);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (13, "Shrimp Teriyaki (새우데리야끼)", "Broiled shrimp glazed with sweet teriyaki sauce", 16.99, 4);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (14, "Tofu Teriyaki (두부데리야끼)", "Stir-fried tofu glazed with sweet teriyaki sauce", 13.99, 4);
-- pan-fried dishes
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (15, "Doobu Yachae Bokeum (두부야채볶음)", "Stir-fried tofu and vegetables in sweet brown sauce", 13.99, 5);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (16, "Jae Yook Bokeum (제육볶음)", "Pan-fried pork sautéed in spicy sauce", 14.99, 5);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (17, "Doobu Kimchi Bokeum (두부김치볶음)", "Pan-fried kimchi and rice cakes in spicy sauce with tofu and sliced pork", 14.99, 5);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (18, "Oh Jing Uh Bokeum (오징어볶음)", "Spicy stir-friend calamari with vegetables", 14.99, 5);
-- rice dishes
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (19, "Bibim Bap (비빔밥)", "Chicken, Tofu, Calamari, or Seafood with assorted vegetables, egg, and rice served with spicy paste on the side", 10.99, 6);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (20, "Dol Sot Bibim Bap (돌솥비빔밥)", "Bibim Bap served in a sizzling stone pot (same choices as bibim bap)", 12.99, 6);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (21, "Bokeum Bap (볶음밥)", "Shrimp, chicken, or kimchi stir-fried rice with vegetables and egg", 10.99, 6);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (22, "Omelet Rice (오무라이스)", "Pan-fried rice with vegetables wrapped in egg with ketchup drizzled on top", 11.99, 6);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (23, "Ja Jang Bap (짜장밥)", "White rice with fried egg served with black soy bean sauce with onion, pork, and zucchini", 10.99, 6);
-- a la carte
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (24, "Tank Soo Yook (탕수육)", "Fried pork or chicken with vegetables in sweet and sour sauce", 14.99, 7);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (25, "Kan Pung Gi (깐풍기)", "Fried chicken or shrimp in sweet, sour, and spicy sauce", 14.99, 7);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (26, "Don Katsu (돈까스)", "Deep fried pork loin in special sauce served with salad and fruit", 12.99, 7);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (27, "Chicken Katsu (치킨까스)", "Deep fried chicken in special sauce served with salad and fruit", 12.99, 7);
-- casseroles
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (28, "Hae Mul Jungol (해물전골)", "Cod, whiting fish, calamari, mussels, tofu, rice cake, and udon with vegetables served in a spicy broth", 32.99, 8);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (29, "Budae Jungol (부대전골)", "Kimchi, pork, sausages, ham, tofu, cheese, and ramyun or vermicelli noodles served in a spicy broth", 32.99, 8);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (30, "Kimchi Mandoo Jungol (김치만두전골)", "Dumplings, rice cake, kimchi, tofu, pork, scallions, and ramyun or vermicelli noodles served in a spicy broth", 32.99, 8);
-- korean classics
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (31, "Dwen Jang Jjigae (된장찌개)", "Traditional Korean soy bean paste soup with tofu and vegetables", 10.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (32, "Kimchi Jjigae (김치찌개)", "Traditional Korean kimchi soup with tofu and pork", 10.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (33, "Soon Doobu Jjigae (순두부찌개)", "Spicy soft tofu soup with seafood, chicken, beef, or pork", 10.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (34, "Budae Jjigae (부대찌개)", "Kimchi, pork, sausages, ham, tofu, cheese, and scallions served in a spicy soup", 12.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (35, "Gochu Jang Doobu Jjigae (고추장두부찌개)", "Hot pepper paste soup with tofu and pork", 12.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (36, "Yuk Gae Jang (육계장)", "Shredded beef with scallions in a spicy broth", 13.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (37, "Kalbi Tang (갈비탕)", "Stewed short ribs in beef broth", 13.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (38, "Dduk Gook (떡국)", "Sliced rice cake with beef in beef broth", 10.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (39, "Dduk Mandoo Gook (떡만두국)", "Sliced rice cake and dumplings in beef soup", 10.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (40, "Mandoo Gook (만두국)", "Dumplings in beef soup", 10.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (41, "Daegoo Maewoon Tang (대구매운탕)", "Spicy cod and mussel casserole with tofu, cabbage, and scallions", 13.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (42, "Saengtae Maewoon Tang (생태매운탕)", "Whiting fish and mussel casserole with tofu, cabbage, and scallions", 13.99, 9);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (43, "Sukkkuh Maewoon Tang (섞어매운탕)", "Spicy cod, whiting fish, calamari, and mussel casserole with tofu, cabbage, and scallions", 13.99, 9);
-- korean bbq
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (44, "Bul Go Gi (불고기)", "Thinly sliced beef tenderloin marinated in house special soy sauce", 15.99, 10);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (45, "Kalbi (갈비)", "Specially marinated short ribs in house special soy sauce", 23.99, 10);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (46, "Daeji Bul Go Gi (돼지불고기)", "Thinly sliced pork marinated in house special ginger and spicy bean paste sauce", 13.99, 10);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (47, "Spicy Dak Gui (매운닭구이)", "Specially marinated chicken in special ginger and spicy bean paste sauce", 13.99, 10);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (48, "Ddook Bae Gi Bul Go Gi (뚝배기불고기)", "Bul Go Gi served in a pot with sauce, vermicelli noodles and scallions", 16.99, 10);
-- noodles in soup
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (49, "Udon (우동)", "Udon noodles with vegetables in a vegetable broth", 10.99, 11);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (51, "Nabe Udon (나베우동)", "Udon served with chicken", 11.99, 11);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (52, "Tempura Udon (튀김우동)", "Udon served with shrimp tempura", 12.99, 11);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (53, "Ramyun (라면)", "", 8.99, 11);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (54, "Tempura Ramyun (튀김라면)", "Vegetable ramyun served with shrimp tempura", 10.99, 11);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (55, "Cham Pong (짬뽕)", "Thick noodles with seafood and vegetables served in a spicy broth", 12.99, 11);
-- noodles in sauce
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (56, "Jap Chae (잡채)", "Pan-fried vermicelli noodles and vegetables", 10.99, 12);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (57, "Ja Jang Myun (짜장면)", "Thick noodles in black soy bean sauce with onion, pork, and zucchini", 10.99, 12);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (58, "Rabokki (라볶이)", "Rice cakes, ramyun, vegetables, and fried dumplings in spicy bean paste sauce", 10.99, 12);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (59, "Ubokki (우볶이)", "Rabokki with udon noodles instead of ramyun", 11.99, 12);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (60, "Udon Bokeum (우동볶음)", "Pan-fried udon noodles in brown sauce and vegetables", 12.99, 12);
-- cold noodles
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (61, "Jjol Myun (쫄면)", "Thick cold noodles with vegetables in spicy pepper paste", 10.99, 13);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (62, "Mul Naeng Myun (물냉면)", "Thin noodles with radish, cucumber, boiled egg, beef, and thinly sliced apples served in a cold broth", 12.99, 13);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (63, "Bibim Naeng Myun (비빔냉면)", "Mul Naeng Myun with spicy sauce instead of cold broth", 13.99, 13);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (64, "Steamed Egg", "", 3.00, 1);
INSERT INTO `menu` (id, menu_name, description, price, category_id) VALUES (65, "Koko Wings", "", 8.99, 1);

-- DIET TAGS SEED DATA
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (1, 1, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (2, 2, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (3, 5, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (4, 5, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (5, 6, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (6, 6, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (7, 6, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (8, 8, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (9, 8, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (10, 9, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (11, 10, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (12, 14, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (13, 14, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (14, 15, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (15, 15, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (16, 18, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (17, 19, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (18, 19, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (19, 19, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (20, 20, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (21, 20, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (22, 20, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (23, 21, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (24, 21, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (25, 21, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (26, 22, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (27, 22, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (28, 22, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (29, 31, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (30, 31, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (31, 31, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (32, 32, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (33, 32, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (34, 32, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (35, 33, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (36, 33, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (37, 33, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (38, 34, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (39, 35, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (40, 35, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (41, 35, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (42, 36, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (43, 37, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (44, 38, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (45, 41, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (46, 42, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (47, 43, 3);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (48, 49, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (49, 49, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (50, 49, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (51, 53, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (52, 56, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (53, 56, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (54, 58, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (55, 59, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (56, 60, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (57, 60, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (58, 61, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (59, 61, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (60, 62, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (61, 62, 2);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (62, 63, 1);
INSERT INTO `diet_tags` (id, menu_id, diet_id) VALUES (63, 63, 2);

-- CATEGORIES SEED DATA
INSERT INTO `categories` (id, category) VALUES (1, "Appetizers");
INSERT INTO `categories` (id, category) VALUES (2, "Salads");
INSERT INTO `categories` (id, category) VALUES (3, "Broiled Fish");
INSERT INTO `categories` (id, category) VALUES (4, "Teriyaki");
INSERT INTO `categories` (id, category) VALUES (5, "Pan Broiled Dishes");
INSERT INTO `categories` (id, category) VALUES (6, "Rice Dishes");
INSERT INTO `categories` (id, category) VALUES (7, "A La Carte");
INSERT INTO `categories` (id, category) VALUES (8, "Casseroles");
INSERT INTO `categories` (id, category) VALUES (9, "Korean Classics");
INSERT INTO `categories` (id, category) VALUES (10, "Korean BBQ");
INSERT INTO `categories` (id, category) VALUES (11, "Noodles in Soup");
INSERT INTO `categories` (id, category) VALUES (12, "Noodles in Sauce");
INSERT INTO `categories` (id, category) VALUES (13, "Cold Noodles");

-- DIETS SEED DATA
INSERT INTO `diets` (id, diet) VALUES (1, "Vegetarian");
INSERT INTO `diets` (id, diet) VALUES (2, "Vegan");
INSERT INTO `diets` (id, diet) VALUES (3, "GlutenFree");

-- IMAGES SEED DATA
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(1, 62, 'mulnaengmyun1.jpg', 'jpg', 'Mul Naeng Myun', 'Jinju Ouck');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(2, 34, 'budaejjigae1.jpg', 'jpg', 'Budae Jjigae', 'Tricia Park');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(3, 34, 'budaejjigae2.jpg', 'jpg', 'Budae Jjigae', 'Tricia Park');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(4, 34, 'budaejjigae3.jpg', 'jpg', 'Budae Jjigae', 'Tricia Park');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(5, 65, 'chickenwings1.jpg', 'jpg', 'Koko Wings', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(6, 65, 'chickenwings2.jpg', 'jpg', 'Koko Wings', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(7, 65, 'chickenwings3.jpg', 'jpg', 'Koko Wings', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(8, 65, 'chickenwings4.jpg', 'jpg', 'Koko Wings', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(9, 17, 'doobukimchibokeum1.jpg', 'jpg', 'Doobu Kimchi Bokeum', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(10, 17, 'doobukimchibokeum2.jpg', 'jpg', 'Doobu Kimchi Bokeum', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(11, 17, 'doobukimchibokeum3.jpg', 'jpg', 'Doobu Kimchi Bokeum', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(12, NULL, 'bar1.jpg', 'jpg', 'Side Dishes', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(13, NULL, 'bar2.jpg', 'jpg', 'Side Dishes', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(14, NULL, 'interior1.jpg', 'jpg', 'Interior', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(15, NULL, 'interior2.jpg', 'jpg', 'Interior', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(16, 4, 'hamulpajun1.jpg', 'jpg', 'Haemul Pajun', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(17, 4, 'hamulpajun2.jpg', 'jpg', 'Haemul Pajun', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(18, 26, 'donkatsu1.jpg', 'jpg', 'Don Katsu', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(19, 26, 'donkatsu2.jpg', 'jpg', 'Don Katsu', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(20, 16, 'jaeyukbokeum.jpg', 'jpg', 'Jaeyook Bokeum', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(21, 1, 'mandoo1.jpg', 'jpg', 'Mandoo', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(22, 1, 'mandoo2.jpg', 'jpg', 'Mandoo', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(23, 65, 'chickenwing.jpg', 'jpg', 'Koko Wings', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(24, 5, 'dukkbokki.jpg', 'jpg', 'Dukkbokki', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(25, 29, 'budaejungol.jpg', 'jpg', 'Budae Jungol', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(26, 21, 'bokeumbap1.jpg', 'jpg', 'Bokeum Bap', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(27, 21, 'bokeumbap2.jpg', 'jpg', 'Bokeum Bap', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(28, 64, 'gyeranjjim1.jpg', 'jpg', 'Steamed Egg', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(29, 64, 'gyeranjjim2.jpg', 'jpg', 'Steamed Egg', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(30, 34, 'budaejjigae4.jpg', 'jpg', 'Budae Jjigae', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(31, 34, 'budaejjigae5.jpg', 'jpg', 'Budae Jjigae', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(32, 62, 'mulnaengmyun2.jpg', 'jpg', 'Mul Naeng Myun', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(33, 62, 'mulnaengmyun3.jpg', 'jpg', 'Mul Naeng Myun', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(34, 44, 'Bulgogi.jpg', 'jpg', 'Bul Go Gi', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(35, 36, 'yukgaejang.jpg', 'jpg', 'Yuk Gae Jang', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(36, 16, 'jaeyukbokeum2.jpg', 'jpg', 'Jaeyuk Bokeum', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(37, 34, 'budaejjigae6.jpg', 'jpg', 'Budae Jjigae', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(38, 62, 'mulnaengmyun3.jpg', 'jpg', 'Mul Naeng Myun', 'KoKo');
INSERT INTO images
	(id, menu_id, image_name, image_ext, description, source)
VALUES
	(39, 62, 'mulnaengmyun4.jpg', 'jpg', 'Mul Naeng Myun', 'KoKo');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (40, 19, 'bibimbap1.jpg', 'jpg', 'Bibimbap', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (41, 19, 'bibimbap2.jpg', 'jpg', 'Bibimbap', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (42, 65, 'kokowings1.jpg', 'jpg', 'Koko Wings', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (43, 65, 'kokowings2.jpg', 'jpg', 'Koko Wings', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (44, 65, 'kokowings3.jpg', 'jpg', 'Koko Wings', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (45, 65, 'kokowings4jpg', 'jpg', 'Koko Wings', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (46, 58, 'rabokki1.jpg', 'jpg', 'Rabokki', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (47, 58, 'rabokki2.jpg', 'jpg', 'Rabokki', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (48, 11, 'salmonteriyaki.jpg', 'jpg', 'Salmon Teriyaki', 'Koko');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (49, 9, 'godeunguh.jpg', 'jpg', 'Godeunguh Gui', 'Koko');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (50, 58, 'rabokki3.jpg', 'jpg', 'Rabokki', 'Koko');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (51, 51, 'nabeudon.jpg', 'jpg', 'Nabe Udon', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (52, 26, 'donkatsu.jpg', 'jpg', 'Don Katsu', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (53, 55, 'champong1.jpg', 'jpg', 'Cham Pong', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (54, 55, 'champong2.jpg', 'jpg', 'Cham Pong', 'Tricia Park');
INSERT INTO images (id, menu_id, image_name, image_ext, description, source) VALUES (55, 48, 'ddookbaegi.jpg', 'jpg', 'Ddook Bae Gi Bul Go Gi', 'Tricia Park');

COMMIT;
