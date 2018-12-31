%define      debug_package %{nil}

%define      app_directory numberfacts

Name:        miamioh-php-numberfacts
Version:     1.0.0
Summary:     NumberFacts application in Laravel
URL:         https://git.itapps.miamioh.edu/solution-delivery-dev/numberfacts

License:     Freely redistributable without restriction
Release:     1.%{_build}.%{_commit}%{?dist}
Source0:     %{name}-%{version}-%{_release}.%{_build}.tar.gz
BuildRoot:   %(mktemp -ud %{_tmppath}/%{name}-%{version}-%{release}-XXXXXX)
BuildArch:   x86_64

%description
Example application showing the development and build process.
%prep
%setup -q -c

%build

%install
rm -rf $RPM_BUILD_ROOT
mkdir $RPM_BUILD_ROOT

mkdir -p -m0755 $RPM_BUILD_ROOT/var
mkdir -p -m0755 $RPM_BUILD_ROOT/var/www/apps
mkdir -p -m0755 $RPM_BUILD_ROOT/var/www/apps/%{app_directory}

cp -rp app $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/app
cp -rp bootstrap $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/bootstrap
cp -rp config $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/config
cp -rp database $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/database
cp -rp public $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/public
cp -rp resources $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/resources
cp -rp routes $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/routes
cp -rp vendor $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/vendor
cp -p artisan $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/artisan
cp -p server.php $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/server.php
cp -p composer.json $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/composer.json

touch $RPM_BUILD_ROOT/var/www/apps/%{app_directory}/.env

%post
if [ -d "/var/www/apps/%{app_directory}/bootstrap/cache" ]; then
    php /var/www/apps/%{app_directory}/artisan cache:clear
    php /var/www/apps/%{app_directory}/artisan view:clear
    php /var/www/apps/%{app_directory}/artisan route:clear
    php /var/www/apps/%{app_directory}/artisan package:discover
fi

%clean
rm -rf $RPM_BUILD_ROOT

%files
%defattr(-, root, root, -)

/var/www/apps/%{app_directory}/app
/var/www/apps/%{app_directory}/bootstrap
/var/www/apps/%{app_directory}/config
/var/www/apps/%{app_directory}/database
/var/www/apps/%{app_directory}/public
/var/www/apps/%{app_directory}/resources
/var/www/apps/%{app_directory}/routes
/var/www/apps/%{app_directory}/vendor
/var/www/apps/%{app_directory}/artisan
/var/www/apps/%{app_directory}/server.php
/var/www/apps/%{app_directory}/composer.json

%config(noreplace) /var/www/apps/%{app_directory}/.env

%changelog
