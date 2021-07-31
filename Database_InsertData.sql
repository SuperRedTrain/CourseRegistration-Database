INSERT INTO student
VALUES (31292,12345,'MATH','Dunn Sean','435 S State St, Ann Arbor, MI 48109','dunnsean@gmail.com','5127456899','College of LAS', 'Fall 2020', 'Bachelor of Science');

INSERT INTO student
VALUES (21395,54321,'CS','Chinni Adithya','512 S State St, Ann Arbor, MI 48109','adithya@gmail.com','5127836605','College of Computer Science', 'Fall 2019', 'Bachelor of Science');

INSERT INTO student
VALUES (22113,34567,'CS','Wang Zhen','332 S State St, Ann Arbor, MI 48109','wzhen@gmail.com','5127930216','College of Computer Science', 'Fall 2020', 'Bachelor of Science');

INSERT INTO student
VALUES (111111,999999,'','Administrator','','','','', '','');




INSERT INTO course
VALUES (120,'Calculus','Mathematics',4);
INSERT INTO course
VALUES (211,'Programming Data Structures','Computer Science',3);
INSERT INTO course
VALUES (341,'Programming Languages','Computer Science',4);
INSERT INTO course
VALUES (360,'Statistical Models','Mathematics',4);
INSERT INTO course
VALUES (480,'Software Engineering','Computer Science',4);


INSERT INTO section
VALUES (12034,120,2019,'Fall','Gillespie William','9:00 am to 11:00 am (Tu, F)');
INSERT INTO section
VALUES (21134,211,2019,'Fall','Bixler Tyler','9:30 am to 11:30 am (M, W)');
INSERT INTO section
VALUES (34101,341,2021,'Fall','Beckman Allan','1:30 pm to 3:30 pm (M, W)');
INSERT INTO section
VALUES (34102,341,2021,'Fall','Bixler Tyler','9:00 am to 11:00 am (Th, F)');
INSERT INTO section
VALUES (36001,360,2021,'Fall','Gillespie William','10:00 am to 11:30 am (M, F)');
INSERT INTO section
VALUES (48001,480,2021,'Fall','Witting Robert','9:00 am to 11:00 am (M, W)');
INSERT INTO section
VALUES (48002,480,2021,'Fall','Gibney Ethan','1:00 pm to 3:00 pm (W, F)');

INSERT INTO grade
VALUES (31292, 12034, 'A');
INSERT INTO grade
VALUES (22113, 12034, 'A');
INSERT INTO grade
VALUES (22113, 21134, 'A');
INSERT INTO grade
VALUES (21395, 21134, 'B');
INSERT INTO grade
VALUES (31292, 21134, 'B');


INSERT INTO prerequisite
VALUES (341, 211);
INSERT INTO prerequisite
VALUES (360, 120);
INSERT INTO prerequisite
VALUES (480, 211);
