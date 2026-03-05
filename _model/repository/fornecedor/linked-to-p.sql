SELECT f.*,	(
		SELECT p.id_produto
		FROM dashboard_app.produto p
		INNER JOIN dashboard_app.produto_fornecedor pf ON p.id_produto = pf.id_produto
		WHERE pf.id_fornecedor = f.id_fornecedor AND pf.id_produto = ?
  ) AS linked
FROM dashboard_app.fornecedor f;
