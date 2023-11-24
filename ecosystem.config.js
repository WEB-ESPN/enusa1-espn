module.exports = {
  apps: [
    {
      name: "enusa",
      script: "artisan",
 interpreter: "php", // Menggunakan interpreter PHP
      script: "/var/www/html/enusa-espn/artisan",
      args: "serve  --host=0.0.0.0 --port=3000",
      autorestart: true,
      watch: false,
      env: {
        NODE_ENV: "production",
      },
    },
  ],
};
