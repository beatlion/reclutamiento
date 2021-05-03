import os
import re


def procesar_archivo(rutaArchivo):
    response = read_txt(rutaArchivo)

    if response["status"]:
        if len(response["data"]) == 4:
            response = validar_datos(response["data"])

            if response["status"]:
                resultado = validar_mensaje(response["data"])
                crear_txt(resultado)

        else:
            response = generate_response("Inconsistencia en los datos", [])

    return response


def read_txt(rutaArchivo):
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
        error = "No se pudo leer el archivo."

    return generate_response(error, listData)


def validar_datos(data):

    response = validar_instrucciones(data)

    if response["status"]:
        responseData = response["data"]

        if responseData[0][0] != len(responseData[1]):
            response = generate_response("Error en linea 2, la longitud no coincide")

        if responseData[0][1] != len(responseData[2]):
            response = generate_response("Error en linea 3, la longitud no coincide")

        if responseData[0][2] != len(responseData[3]):
            response = generate_response("Error en linea 4, la longitud no coincide")

    return response


def validar_instrucciones(data):
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
                break

        if error == "":
            M1 = nuevaLista[0]
            M2 = nuevaLista[1]
            N = nuevaLista[2]

            if M1 < 2:
                error = "Error en datos: linea 1, la longitud de la instrucción 1 debe ser mayor a 2"

            elif M1 > 50:
                error = "Error en datos: linea 1, la longitud de la instrucción 1 debe ser menor a 50"

            elif M2 < 2:
                error = "Error en datos: linea 1, la longitud de la instrucción 2 debe ser mayor a 2"

            elif M2 > 50:
                error = "Error en datos: linea 1, la longitud de la instrucción 2 debe ser menor a 50"

            else:
                error = (
                    ""
                    if re.match("^[a-zA-Z0-9]+$", data[3]) is not None
                    else "Error en datos: linea 4, formato de mensaje, solo debe contener letras y números"
                )

        data[0] = nuevaLista

    return generate_response(error, data)


def validar_mensaje(data):

    nuevoM1 = limpiar_mensaje(data[1])
    nuevoM2 = limpiar_mensaje(data[2])
    nuevoMensaje = limpiar_mensaje(data[3])
    resultado = ""

    M1 = "Si\n" if nuevoM1 in nuevoMensaje else "No\n"
    M2 = "Si" if nuevoM2 in nuevoMensaje else "No"

    return M1 + M2


def limpiar_mensaje(mensaje):
    nuevoMensaje = ""
    letraAnterior = ""

    for letra in mensaje:
        letraMinus = letra.lower()

        if letraAnterior != "" and letraAnterior != letraMinus:
            nuevoMensaje += letra

        letraAnterior = letraMinus

    return nuevoMensaje


def crear_txt(resultado):
    rutaTxt = os.path.abspath("resultados_problema1.txt")

    archivo = open(rutaTxt, "w")
    archivo.write(resultado)
    archivo.close()


def generate_response(error, data=[]):
    return {
        "status": (error == ""),
        "message": error
        if (error != "")
        else "Archivo procesado correctamente, se genero un archivo (resultados_problema1.txt) con los resultados",
        "data": data if (error == "") else [],
    }
