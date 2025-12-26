-- Sample Tether Data for XenForo Tether BBCode System
-- This file contains example tether data based on the Arachna's Swansong example
-- Import this after installing the addon to have sample data

-- Note: You may need to adjust the tether_id values if you already have tethers in your database

INSERT INTO xf_miatoro_tether (
    identifier,
    title,
    category,
    tags,
    wiki_url,
    image_path,
    description,
    negative_1,
    negative_4,
    negative_7,
    positive_1,
    positive_3,
    positive_7,
    created_date,
    modified_date
) VALUES (
    'arachnas-swansong',
    'Arachna\'s Swansong',
    'Death',
    'Spider, Venom, Psychological',
    'https://terrarp.com/wiki/arachnas-swansong_(tether)',
    '/db/tethers/arachnas-swansong.webp',
    'When you see or feel the presence of her spawn, even the smallest of spiders, your veins pulse visibly beneath your skin, dark and swollen, as if filled with venom. Check as you might, there\'s not a single bite anywhere on your body. The nearer you are to your bane, the more intense the pain, as if they remember the pain you had inflicted on their kind. Suffer their hatred, killer.',
    'Deepen I: Each time you kill an arachnid, a single fanged puncture appears somewhere on your body and becomes a permanent source of localized pain as a reminder of their hatred for you.',
    'Deepen IV: When you go without killing an arachnid for a while, a psychological nest opens in your mind and inflicts you with pain from those phantom spiderlings.',
    'Deepen VII: To be expanded.',
    'Mend I: Roll a 1d4, on a 1, the swansong is unchanged. On a 2 or 3, the effect is lessened. On a 4, the effect is negated until you see another arachnid.',
    'Mend III: When your veins pulse with the phantom venom, you can use your blood to inflict its effects on an enemy. You may willingly fail Resolve 1 to activate this.',
    'Mend VII: To be expanded.',
    UNIX_TIMESTAMP(),
    UNIX_TIMESTAMP()
);

-- Additional example tethers
INSERT INTO xf_miatoro_tether (
    identifier,
    title,
    category,
    tags,
    wiki_url,
    image_path,
    description,
    negative_1,
    negative_2,
    negative_3,
    positive_1,
    positive_2,
    positive_3,
    created_date,
    modified_date
) VALUES (
    'shadow-binding',
    'Shadow Binding',
    'Entity',
    'Shadow, Darkness, Binding',
    'https://terrarp.com/wiki/shadow-binding_(tether)',
    '/db/tethers/shadow-binding.webp',
    'Shadows cling to you like living things, wrapping around your limbs in the darkness. They whisper secrets of things best left forgotten, binding you to their realm.',
    'Deepen I: In darkness, shadows visibly reach toward you, creating an unsettling aura.',
    'Deepen II: Your own shadow sometimes moves independently, startling those who notice.',
    'Deepen III: Prolonged time in darkness causes physical exhaustion as the shadows drain your energy.',
    'Mend I: You can see clearly in dim light and darkness, gaining superior night vision.',
    'Mend II: Shadows provide you with concealment, granting advantage on stealth checks in dim light.',
    'Mend III: You can briefly step through shadows to teleport short distances.',
    UNIX_TIMESTAMP(),
    UNIX_TIMESTAMP()
);

INSERT INTO xf_miatoro_tether (
    identifier,
    title,
    category,
    tags,
    wiki_url,
    image_path,
    description,
    negative_1,
    negative_2,
    negative_3,
    negative_4,
    positive_1,
    positive_2,
    positive_3,
    positive_4,
    created_date,
    modified_date
) VALUES (
    'void-whisper',
    'Void Whisper',
    'God',
    'Void, Cosmic, Madness',
    'https://terrarp.com/wiki/void-whisper_(tether)',
    '/db/tethers/void-whisper.webp',
    'The void between stars speaks to you in a language that predates existence. Its whispers carry truths that mortal minds were never meant to comprehend.',
    'Deepen I: You occasionally hear faint whispers when in complete silence.',
    'Deepen II: The whispers grow louder, occasionally interrupting your concentration.',
    'Deepen III: Sleep becomes difficult as the void\'s voice never truly stops.',
    'Deepen IV: You begin to understand fragments of the whispers, revealing cosmic truths.',
    'Mend I: The whispers occasionally warn you of immediate danger.',
    'Mend II: You can ask the void a single question per day and receive a cryptic answer.',
    'Mend III: Understanding the void\'s language grants you resistance to psychic damage.',
    'Mend IV: You can channel the void\'s power to silence all sound in a small area.',
    UNIX_TIMESTAMP(),
    UNIX_TIMESTAMP()
);

INSERT INTO xf_miatoro_tether (
    identifier,
    title,
    category,
    tags,
    wiki_url,
    image_path,
    description,
    negative_1,
    negative_2,
    positive_1,
    positive_2,
    created_date,
    modified_date
) VALUES (
    'feast-eternal',
    'Feast Eternal',
    'Eater',
    'Hunger, Consumption, Greed',
    'https://terrarp.com/wiki/feast-eternal_(tether)',
    '/db/tethers/feast-eternal.webp',
    'An insatiable hunger gnaws at your core, a reminder of the feast you partook in. Food no longer satisfies as it once did, and you find yourself craving... more.',
    'Deepen I: Normal food tastes like ash in your mouth, providing little satisfaction.',
    'Deepen II: The hunger intensifies, requiring twice the normal amount of food to feel satiated.',
    'Mend I: You can consume anything organic without ill effects, drawing sustenance from unusual sources.',
    'Mend II: By consuming a portion of a defeated foe, you temporarily gain insight into their abilities.',
    UNIX_TIMESTAMP(),
    UNIX_TIMESTAMP()
);

INSERT INTO xf_miatoro_tether (
    identifier,
    title,
    category,
    tags,
    wiki_url,
    image_path,
    description,
    negative_1,
    negative_2,
    negative_3,
    positive_1,
    positive_2,
    positive_3,
    created_date,
    modified_date
) VALUES (
    'blood-oath',
    'Blood Oath',
    'Dedication',
    'Blood, Oath, Loyalty',
    'https://terrarp.com/wiki/blood-oath_(tether)',
    '/db/tethers/blood-oath.webp',
    'An oath sealed in blood is not easily broken. The weight of your promise manifests physically, a constant reminder of your dedication.',
    'Deepen I: Breaking minor promises causes sharp pains in your chest.',
    'Deepen II: You are compelled to keep your word, feeling physically ill when you attempt to lie.',
    'Deepen III: The oath manifests as glowing runes on your skin when you speak a promise.',
    'Mend I: Oaths you make carry supernatural weight, granting you advantage when fulfilling sworn duties.',
    'Mend II: You can detect when others break their promises to you.',
    'Mend III: By invoking your oath, you gain temporary strength and resilience when defending those you\'ve sworn to protect.',
    UNIX_TIMESTAMP(),
    UNIX_TIMESTAMP()
);

-- Example usage in BBCode:
-- [tether=arachnas-swansong]positive1,negative4[/tether]
-- [tether=shadow-binding]positive2,negative1[/tether]
-- [tether=void-whisper]positive3,negative3[/tether]
-- [tether=feast-eternal]positive1,negative2[/tether]
-- [tether=blood-oath]positive2,negative2[/tether]
