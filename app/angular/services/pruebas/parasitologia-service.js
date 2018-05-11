var app = angular.module('vosandesApp.parasitologiaServices', [])

app.factory('parasitologiaServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

    var self = {
        insertar: function (datos) {
            console.log(datos)
            var d = $q.defer();
            $http({
                method: 'POST',
                url: PATH + 'parasitologia-pruebas/add',
                data: datos
            })
                .then(function successCallback(response) {
                    self.response = response.data;
                    return d.resolve()
                }, function errorCallback(response) {
                    self.response = response.data
                    return d.resolve();
                });
            return d.promise;

        },
        listar: function (data) {
            var d = $q.defer();

            $http({
                method: 'POST',
                url: PATH + 'parasitologia-pruebas/list',
                data: data
            })
                .then(function successCallback(response) {
                    self.response = response.data;
                    return d.resolve()
                }, function errorCallback(response) {
                    return d.resolve()
                    self.response = response.data
                });
            return d.promise;

        },
        modificar: function (data) {
            var d = $q.defer();
            $http({
                method: 'PUT',
                url: PATH + 'parasitologia-pruebas/edit/' + data.id,
                data: data
            })
                .then(function successCallback(response) {
                    self.response = response.data;
                    return d.resolve()
                }, function errorCallback(response) {
                    return d.resolve()
                    self.response = response.data
                });
            return d.promise;
        },
        eliminar: function (user) {
            var d = $q.defer();
            $http({
                method: 'POST',
                url: PATH + 'parasitologia-pruebas/delete/' + user.id,
                data: user
            })
                .then(function successCallback(response) {
                    self.response = response.data;

                    return d.resolve()
                }, function errorCallback(response) {
                    return d.resolve()
                    self.response = response.data
                });
            return d.promise;
        }

    }
    return self;
}])