DROP VIEW IF EXISTS product_variation_stock_view;

CREATE VIEW product_variation_stock_view AS
    SELECT
        product_variations.product_id AS product_id,
        product_variations.id AS product_variation_id,
        COALESCE(SUM(stocks.quantity), 0) as stock
    FROM product_variations
    LEFT JOIN (
        SELECT stocks.product_variation_id as id,
        SUM(stocks.quantity) as quantity
        FROM stocks
        GROUP BY stocks.product_variation_id
    ) AS stocks USING (id)
    GROUP BY product_variations.id
