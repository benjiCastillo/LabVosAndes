var app = angular.module('vosandesApp.usuariosServices', [])

app.factory('usuariosServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

    var self = {
        insertar: function (datos) {
            console.log(datos)
            var d = $q.defer();
            $http({
                method: 'POST',
                url: PATH + 'usuarios/add',
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
                url: PATH + 'usuarios/list',
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
                url: PATH + 'usuarios/edit/' + data.id,
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
                url: PATH + 'usuarios/delete/' + user.id,
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
        },
        logout: function (datos) {
            var d = $q.defer();
            $http({
                method: 'POST',
                url: PATH + 'usuarios/logout',
                data: datos
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