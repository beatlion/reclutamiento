import unittest
import sys

sys.path.append("./app")

from Processor import Processor


class ValidarInstruccionesExceptionTest(unittest.TestCase):
    def test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_las_instrucciones_incompletas(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "11 14",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_las_instrucciones_incompletas"
            )

    def test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_primer_instruccion_menor_a_dos(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "1 14 80",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_primer_instruccion_menor_a_dos"
            )

    def test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_primer_instruccion_mayor_a_cincuenta(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "55 14 80",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_primer_instruccion_mayor_a_cincuenta"
            )

    def test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_segunda_instruccion_menor_a_dos(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "11 1 80",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_segunda_instruccion_menor_a_dos"
            )

    def test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_segunda_instruccion_mayor_a_cincuenta(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "11 51 80",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_segunda_instruccion_mayor_a_cincuenta"
            )

    def test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_tercer_instruccion_menor_a_tres(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "11 1 2",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_tercer_instruccion_menor_a_tres"
            )

    def test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_tercer_instruccion_mayor_a_cincomil(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "11 14 5001",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_1_por_recibir_la_tercer_instruccion_mayor_a_cincomil"
            )

    def test_validar_instrucciones_genera_un_exception_linea_2_por_recibir_caracteres_repetidos(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "12 14 80",
                    "CeseAlFuegoo",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_validar_instrucciones_genera_un_exception_linea_2_por_recibir_caracteres_repetidos"
            )

    def test_validar_instrucciones_genera_un_exception_linea_3_por_recibir_caracteres_repetidos(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "12 15 80",
                    "CeseAlFuego",
                    "CorranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==> test_validar_instrucciones_genera_un_exception_linea_3_por_recibir_caracteres_repetidos"
            )

    def test_validar_instrucciones_genera_un_exception_linea_4_por_recibir_caracteres_especiales(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_instrucciones(
                [
                    "12 14 80",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFuee%egoooranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==> test_validar_instrucciones_genera_un_exception_linea_4_por_recibir_caracteres_especiales"
            )
