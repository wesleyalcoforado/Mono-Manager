# Makefile
#
# Makefile para o modelo de monografia em LaTeX da UECE
#
# Autor: Rudy Matela
# Data: 20091013


# Variables

filename=mono
FIGS=#fig/graph.pdf fig/watermark.pdf fig/diagram.pdf fig/euler.pdf


# Includes

include imagerules.mk


# Recipe!

all: $(filename).pdf

$(filename).pdf: $(filename).tex bib.bib $(FIGS)
	pdflatex $(filename).tex
	bibtex $(filename)
	pdflatex $(filename).tex
	# Gambiarra, removendo alguns itens do sumário
	cat $(filename).toc | \
		grep -v -E '{Resumo|Abstract|Lista de Figuras|Lista de Tabelas|Lista de Siglas|Lista de S.*mbolos}' \
		> $(filename).toc.2
	mv $(filename).toc.2 $(filename).toc
	pdflatex $(filename).tex

.PHONY: figs
figs: $(FIGS)

# Cleanup recipe!

.PHONY: clean cleanfigs
clean:
	rm -f *~ *.aux *.bbl *.blg *.log *.toc *.lof *.lot *.lsg *.lsb
	rm -f *.pdf
	${MAKE} -C fig clean

cleanfigs:
	rm -f $(FIGS)

