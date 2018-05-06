<?php

namespace App\Utils;

/**
 * Constants
 * @author Lucio Marcelo Quispe Ortega <marceloquispeortega@gmail.com>
 */
class Constants {

    const PAGINATE = 20;

    /**
     * Estado de registros
     */
    const STATUS_ACTIVE = 'A';
    const STATUS_INACTIVE = 'I';

    /**
     * Tipo de Cuentas
     */
    const ACCOUNT_BOTH = 'B';
    const ACCOUNT_INCOME = 'I';
    const ACCOUNT_EXPENSE = 'E';

    /**
     * Expedidos
     */
    const ISSUED_CHUQUISACA = 'CH';
    const ISSUED_BENI = 'BN';
    const ISSUED_COCHABAMBA = 'CB';
    const ISSUED_LA_PAZ = 'LP';
    const ISSUED_ORURO = 'OR';
    const ISSUED_PANDO = 'PN';
    const ISSUED_POTOSI = 'PT';
    const ISSUED_SANTA_CRUZ = 'SC';
    const ISSUED_TARIJA = 'TJ';

    /**
     * Universidades
     */
    const UNIVERSITY_UMRPSFXCH = 'U.M.R.P.S.F.X.CH.';
    const UNIVERSITY_UNIVALLE = 'UNIVALLE';
    const UNIVERSITY_UBI = 'U.B.I';
    const UNIVERSITY_UATF = 'U.A.T.F.';
    const UNIVERSITY_UTO = 'U.T.O.';
    const UNIVERSITY_UMSS = 'U.M.S.S.';
    const UNIVERSITY_UMSA = 'U.M.S.A.';
    const UNIVERSITY_UAJMS = 'U.A.J.M.S.';
    const UNIVERSITY_UCB = 'U.C.B.';
    const UNIVERSITY_OTHER = 'OTRA';

    /**
     * Especialidades
     */
    const SPECIALITY_STRUCTURES = 'ESTRUCTURAS';
    const SPECIALITY_HYDRO_SANITARY = 'HIDRO SANITARIO';
    const SPECIALITY_ROADS = 'VÍAS Y CARRETERAS';
    const SPECIALITY_ENVIRONMENT = 'MEDIO AMBIENTE';
    const SPECIALITY_GEOTECHNY = 'GEOTECNIA';
    const SPECIALITY_OTHER = 'OTRA';

    /**
     * Métodos de Pago
     */
    const METHOD_CASH = 'E';
    const METHOD_DEPOSIT = 'D';
    const METHOD_CHECK = 'C';
    const METHOD_TRANSFER = 'T';

    /**
     * Estados de Movimiento
     */
    const STATUS_VALID = 'V';
    const STATUS_ANNULLED = 'A';

    /**
     * Tipos de Movimiento
     */
    const TYPE_INCOME = 'I';
    const TYPE_EXPENSE = 'E';

    /**
     * Aplicable a deudores
     */
    const BACKWARD_YES = 'Y';
    const BACKWARD_NO = 'N';

    /**
     * Estado de los cheques
     */
    const CHECK_GENERATED = 'G';
    const CHECK_DELIVERED = 'D';
    const CHECK_PRINTED = 'P';

    public static function getStates() {
        $states = [
            self::STATUS_ACTIVE => 'Activo',
            self::STATUS_INACTIVE => 'Inactivo'
        ];
        return $states;
    }

    public static function getAccountTypes() {
        $types = [
            self::ACCOUNT_BOTH => 'Ambos',
            self::ACCOUNT_INCOME => 'Ingreso',
            self::ACCOUNT_EXPENSE => 'Egreso'
        ];
        return $types;
    }

    public static function getIssuedList() {
        $issuedList = [
            self::ISSUED_CHUQUISACA => 'CH',
            self::ISSUED_BENI => 'BN',
            self::ISSUED_COCHABAMBA => 'CB',
            self::ISSUED_LA_PAZ => 'LP',
            self::ISSUED_ORURO => 'OR',
            self::ISSUED_PANDO => 'PN',
            self::ISSUED_POTOSI => 'PT',
            self::ISSUED_SANTA_CRUZ => 'SC',
            self::ISSUED_TARIJA => 'TJ'
        ];
        return $issuedList;
    }

    public static function getUniversities() {
        $universities = [
            self::UNIVERSITY_UMRPSFXCH => 'U.M.R.P.S.F.X.CH.',
            self::UNIVERSITY_UNIVALLE => 'UNIVALLE',
            self::UNIVERSITY_UBI => 'U.B.I',
            self::UNIVERSITY_UATF => 'U.A.T.F.',
            self::UNIVERSITY_UTO => 'U.T.O.',
            self::UNIVERSITY_UMSS => 'U.M.S.S.',
            self::UNIVERSITY_UMSA => 'U.M.S.A.',
            self::UNIVERSITY_UAJMS => 'U.A.J.M.S.',
            self::UNIVERSITY_UCB => 'U.C.B.',
            self::UNIVERSITY_OTHER => 'OTRA'
        ];
        return $universities;
    }

    public static function getSpecialities() {
        $specialities = [
            self::SPECIALITY_STRUCTURES => 'ESTRUCTURAS',
            self::SPECIALITY_HYDRO_SANITARY => 'HIDRO SANITARIO',
            self::SPECIALITY_ROADS => 'VÍAS Y CARRETERAS',
            self::SPECIALITY_ENVIRONMENT => 'MEDIO AMBIENTE',
            self::SPECIALITY_GEOTECHNY => 'GEOTECNIA',
            self::SPECIALITY_OTHER => 'OTRA'
        ];
        return $specialities;
    }

    public static function getPaymentMethods() {
        $methods = [
            self::METHOD_CASH => 'Efectivo',
            self::METHOD_DEPOSIT => 'Depósito',
            self::METHOD_CHECK => 'Cheque',
            self::METHOD_TRANSFER => 'Transferencia'
        ];
        return $methods;
    }

    public static function getMovementStates() {
        $movementStates = [
            self::STATUS_VALID => 'Válido',
            self::STATUS_ANNULLED => 'Anulado'
        ];
        return $movementStates;
    }

    public static function getMovementTypes() {
        $movementTypes = [
            self::TYPE_INCOME => 'Ingreso',
            self::TYPE_EXPENSE => 'Egreso'
        ];
        return $movementTypes;
    }

    public static function getCheckStatus() {
        $checkStatus = [
            self::CHECK_GENERATED => 'Generado',
            self::CHECK_PRINTED => 'Impreso',
            self::CHECK_DELIVERED => 'Entregado'
        ];
        return $checkStatus;
    }

    public static function getBackwardValues() {
        $backwardValues = [
            self::BACKWARD_YES => 'Y',
            self::BACKWARD_NO => 'N'
        ];
        return $backwardValues;
    }

}
