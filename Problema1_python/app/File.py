import os


class File:
    def read_txt(self, rutaArchivo):
        listData = []
        error = ""
        status = True

        try:
            txt = open(rutaArchivo, "r")
            line = txt.readline()

            while line:
                lineTemp = line.strip()

                if lineTemp != "":
                    listData.append(line.replace("\n", ""))

                line = txt.readline()

            txt.close()
        except:
            raise ValueError("No se pudo leer el archivo.")

        finally:
            if not (txt.closed):
                txt.close()

        return listData

    def crear_txt(self, resultado):
        rutaTxt = os.path.abspath("resultados_problema1.txt")

        archivo = open(rutaTxt, "w")
        archivo.write(resultado)
        archivo.close()
