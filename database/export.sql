SELECT
    ut.id AS test_id,
    ut.created_at,
    ut.total_same,
    ut.clicked_same,
    ut.passed_same,
    ut.total_ordinary,
    ut.clicked_ordinary,
    ut.passed_ordinary,
    ut.total_points,
    CASE WHEN ut.interruption THEN 'yes' ELSE 'no' END AS interruption,
    ut.interruption_reason,

    u.age AS user_age,
    CASE
        WHEN u.lang_level = 0 THEN 'A0'
        WHEN u.lang_level = 1 THEN 'A1'
        WHEN u.lang_level = 2 THEN 'A2'
        WHEN u.lang_level = 3 THEN 'B1'
        WHEN u.lang_level = 4 THEN 'B2'
        WHEN u.lang_level = 5 THEN 'C1'
        WHEN u.lang_level = 6 THEN 'C2'
    END AS user_lang_level,
    CASE
        WHEN u.lang_start = -1 THEN 'no language'
        WHEN u.lang_start = 0 THEN '0 - 3 y/o'
        WHEN u.lang_start = 3 THEN '3 - 5 y/o'
        WHEN u.lang_start = 6 THEN '6 - 15 y/o'
        WHEN u.lang_start = 16 THEN '16+ y/o'
    END AS user_lang_start,
    u.sex AS user_sex,
    CASE
        WHEN u.lang_start = 0 THEN 'Žádné / nedokončené základní'
        WHEN u.lang_start = 1 THEN 'Základní'
        WHEN u.lang_start = 2 THEN 'Střední s výučním listem'
        WHEN u.lang_start = 3 THEN 'Střední s maturitou'
        WHEN u.lang_start = 4 THEN 'Vyšší odborné - titul DiS'
        WHEN u.lang_start = 5 THEN 'Vysokoškolské - bakalářský stupeň'
        WHEN u.lang_start = 6 THEN 'Vysokoškolské - magisterský stupeň'
        WHEN u.lang_start = 7 THEN 'Vysokoškolské - doktorský stupeň'
    END AS user_education,
    u.passive_languages AS user_passive_languages,
    u.active_languages AS user_active_languages,
    CASE WHEN u.disorder THEN 'yes' ELSE 'no' END AS user_disorder
FROM
    user_tests AS ut
JOIN users AS u ON u.id = ut.user_id
WHERE
    ut.created_at >= '2023-03-08' AND
    ut.is_main_test = 1 AND
    1=1
ORDER BY ut.created_at ASC
