import re
from File import File


class Processor(File):
    data = ""

    """ recibe la ruta del archivo y comienza a procesarlo """

    def procesar_archivo(self, rutaArchivo):
        error = ""
        try:
            data = self.read_txt(rutaArchivo)

            if len(data) == 4:
                self.validar_datos(data)

                resultado = self.generar_mensaje(data)
                self.crear_txt(resultado)

            else:
                raise ValueError("Inconsistencia en los datos")

        except ValueError as e:
            error = e

        return self.generate_response(error)

    """ valida que las instrucciones y los textos coincidan, y manda a hacer otras validaciones """

    def validar_datos(self, data):
        self.validar_instrucciones(data)

        if self.data[0][0] != len(self.data[1]):
            raise ValueError(
                "Error en linea 1 y linea 2, la longitud no coincide con el parámetro 1"
            )

        if self.data[0][1] != len(self.data[2]):
            raise ValueError(
                "Error en linea 1 y linea 3, la longitud no coincide con el parámetro 2"
            )

        if self.data[0][2] != len(self.data[3]):
            raise ValueError(
                "Error en linea 1 y linea 4, la longitud no coincide con el parámetro 3"
            )

    """ valida los datos del archivo, instrucciones, mensajes, longitudes y si son números """

    def validar_instrucciones(self, data):
        error = ""
        insList = data[0].split(" ")
        nuevaLista = []

        if len(insList) != 3:
            error = "Error en datos: linea 1, cantidad de parámetros es errónea"

        else:
            for num in insList:
                if num.isnumeric():
                    nuevaLista.append(int(num))

                else:
                    error = "Error en datos: linea 1, parámetros no numéricos"

            if error == "":
                M1 = nuevaLista[0]
                M2 = nuevaLista[1]
                N = nuevaLista[2]

                instruccion1 = data[1]
                instruccion2 = data[2]
                mensaje = data[3]

                if M1 < 2:
                    error = "Error en datos: linea 1, la longitud de la instrucción 1 debe ser mayor a 2"

                elif M1 > 50:
                    error = "Error en datos: linea 1, la longitud de la instrucción 1 debe ser menor a 50"

                elif M2 < 2:
                    error = "Error en datos: linea 1, la longitud de la instrucción 2 debe ser mayor a 2"

                elif M2 > 50:
                    error = "Error en datos: linea 1, la longitud de la instrucción 2 debe ser menor a 50"

                elif N < 3:
                    error = "Error en datos: linea 1, la longitud del mensaje debe ser mayor a 3"

                elif N > 5000:
                    error = "Error en datos: linea 1, la longitud de la instrucción 2 debe ser menor a 5000"

                elif self.letras_consecutivas_repetidas(instruccion1):
                    error = "Error en datos: linea 2, la instrucción contiene caracteres repetidos."

                elif self.letras_consecutivas_repetidas(instruccion2):
                    error = "Error en datos: linea 3, la instrucción contiene caracteres repetidos."

                else:
                    error = (
                        ""
                        if re.match("^[a-zA-Z0-9]+$", mensaje) is not None
                        else "Error en datos: linea 4, formato de mensaje, solo debe contener letras y números"
                    )

            self.data = data
            self.data[0] = nuevaLista

        if error != "":
            raise ValueError(error)

    """ retorna un string con el resultado del archivo, si no tiene dos posibles mensajes """

    def generar_mensaje(self, data):

        nuevoM1 = data[1]
        nuevoM2 = data[2]
        nuevoMensaje = self.limpiar_mensaje(data[3])
        resultado = ""

        M1 = "Si" if nuevoM1 in nuevoMensaje else "No"
        M2 = "Si" if nuevoM2 in nuevoMensaje else "No"

        if M1 == "Si" and M2 == "Si":
            raise ValueError(
                "Se obtuvieron dos posibles mensajes, por lo cual no se pudo obtener el mensaje."
            )
        else:
            resultado = M1 + "\n" + M2

        return resultado

    """ retorna un booleano, busca caracteres consecutivos en el texto recibido  """

    def letras_consecutivas_repetidas(self, texto):
        letraAnterior = ""
        result = False

        for letra in texto:
            letraMinus = letra.lower()

            if letraAnterior == letraMinus:
                result = True
                break

            letraAnterior = letraMinus

        return result

    """ Limpia el texto recibido, elimina caracteres iguales consecutivos """

    def limpiar_mensaje(self, mensaje):
        nuevoMensaje = ""

        letraAnterior = ""

        for letra in mensaje:
            letraMinus = letra.lower()

            if letraAnterior != letraMinus:
                nuevoMensaje += letra

            letraAnterior = letraMinus

        return nuevoMensaje

    """ Genera una respuesta tipo arreglo con un status y un mensaje"""

    def generate_response(self, error):
        return {
            "status": (error == ""),
            "message": error
            if (error != "")
            else "Archivo procesado correctamente, se genero un archivo (resultados_problema1.txt) con los resultados",
        }
