SELECT p.*,	(
		SELECT COUNT(f.id_fornecedor)
		FROM dashboard_app.fornecedor f
		INNER JOIN dashboard_app.produto_fornecedor pf ON f.id_fornecedor = pf.id_fornecedor
		WHERE pf.id_produto = p.id_produto
  ) AS fornecedores
FROM dashboard_app.produto p;
