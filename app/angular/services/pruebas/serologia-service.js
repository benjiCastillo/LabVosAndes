var app = angular.module('vosandesApp.serologiaServices', [])

app.factory('serologiaServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

    var self = {
        insertar: function (datos) {
            console.log(datos)
            var d = $q.defer();
            $http({
                method: 'POST',
                url: PATH + 'serologia-pruebas/add',
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
                url: PATH + 'serologia-pruebas/list',
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
                url: PATH + 'serologia-pruebas/edit/' + data.id,
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
                url: PATH + 'serologia-pruebas/delete/' + user.id,
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