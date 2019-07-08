SET @salesChannelId = (SELECT `id` FROM sales_channel WHERE type_id = unhex('8a243080f92e4c719546314b577cf82b'));
SET @paymentMethodId = (SELECT `id` FROM `payment_method` WHERE `active` = 1 LIMIT 1);
SET @countryId = (SELECT `id` FROM `country` WHERE UPPER(`iso`) = 'DE');
SET @salutationId = (SELECT COALESCE(
	(SELECT `id` FROM `salutation` WHERE `salutation_key` = 'mr'),
	(SELECT `id` FROM `salutation`)
));
SET @categoryId = (SELECT COALESCE(
	(SELECT `id` FROM `category` WHERE `auto_increment` = 1),
	(SELECT `id` FROM `category` WHERE `active` AND parent_id IS NULL)
));
SET @categoryVersionId = (SELECT `version_id` FROM `category` WHERE id = @categoryId);
SET @taxId = (SELECT COALESCE(
	(SELECT `id` FROM `tax` WHERE tax_rate = '19.00'),
	(SELECT `id` FROM `tax`)
));
SET @ruleId = (SELECT `id` FROM `rule` LIMIT 1);

UPDATE customer
SET `sales_channel_id` = @salesChannelId,
    `default_payment_method_id` = @paymentMethodId;

UPDATE `customer_address`
SET `country_id` = @countryId,
    `salutation_id` = @salutationId;

UPDATE `sales_channel`
SET `navigation_category_id` = @categoryId,
    `navigation_category_version_id` = @categoryVersionId;

UPDATE `product`
SET `tax_id` = @taxId;

UPDATE `product_visibility`
SET `sales_channel_id` = @salesChannelId;

UPDATE `shipping_method`
SET `availability_rule_id` = @ruleId;