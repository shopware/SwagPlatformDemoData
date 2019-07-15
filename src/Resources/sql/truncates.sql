DELETE FROM `category`;
DELETE FROM `cms_block`;
DELETE FROM `cms_page`;
DELETE FROM `cms_slot`;
DELETE FROM `customer`;
DELETE FROM `customer_address`;
DELETE FROM `media`
WHERE `media`.`id` NOT IN (
    SELECT `id`
    FROM (
        SELECT `media`.`id` AS `id`
        FROM `media`
        INNER JOIN `media_folder` ON `media`.`media_folder_id` = `media_folder`.`id`
        INNER JOIN `media_default_folder` ON `media_folder`.`default_folder_id` = `media_default_folder`.`id`
        WHERE `media_default_folder`.`entity` = "theme"
    ) AS `temp`
);
DELETE FROM `product`;
DELETE FROM `product_category`;
DELETE FROM `product_category_tree`;
DELETE FROM `product_configurator_setting`;
DELETE FROM `product_manufacturer`;
DELETE FROM `product_media`;
DELETE FROM `product_option`;
DELETE FROM `product_price`;
DELETE FROM `product_property`;
DELETE FROM `product_translation`;
DELETE FROM `product_visibility`;
DELETE FROM `property_group`;
DELETE FROM `property_group_option`;
DELETE FROM `rule`;
DELETE FROM `rule_condition`;
DELETE FROM `product_keyword_dictionary`;
DELETE FROM `product_search_keyword`;