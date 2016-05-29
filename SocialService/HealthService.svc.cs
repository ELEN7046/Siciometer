using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.Text;
using MySql.Data.MySqlClient;
using Newtonsoft;
using System.Web.Script.Serialization;

namespace SocialService
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the class name "HealthService" in code, svc and config file together.
    // NOTE: In order to launch WCF Test Client for testing this service, please select HealthService.svc or HealthService.svc.cs at the Solution Explorer and start debugging.
    public class HealthService : IHealthService
    {
        //public List<HealthProfile> getHealthProfiles()
        //{
        //    List<HealthProfile> employees = new List<HealthProfile>();
        //    string connectionString = "Server=winmysqls03.cpt.wa.co.za:3307;Uid=wits01;Pwd=Pr0ject;Database=waronpoverty;";
        //    using (MySqlConnection connection = new MySqlConnection())
        //    {
        //        connection.ConnectionString = connectionString;
        //        connection.Open();
        //        MySqlCommand command = connection.CreateCommand();
        //        string sql;
        //        sql = "SELECT * FROM tbl_7046provincedistrictlocalhealthneeds";
        //        command.CommandText = sql;
        //        MySqlDataReader reader = command.ExecuteReader();
        //        while (reader.Read())
        //        {
        //            HealthProfile employee = new HealthProfile();
        //            employee.Employee_ID = Convert.ToInt32(reader["Employee_ID"]);
        //            employee.FirstName = Convert.ToString(reader["FirstName"]);
        //            employee.LastName = Convert.ToString(reader["LastName"]);
        //            employees.Add(employee);
        //        }
        //        return employees.ToList();
        //    }
        //}
        //public HealthProfile getHealthProfilebyProvinceID(Int32 empId)
        //{
        //    HealthProfile employees = new HealthProfile();
        //    string connectionString = "Data Source=orcl;Persist Security Info=True;" +
        //           "User ID=system;Password=password-1;Unicode=True";
        //    using (OracleConnection connection = new OracleConnection())
        //    {
        //        connection.ConnectionString = connectionString;
        //        connection.Open();
        //        OracleCommand command = connection.CreateCommand();
        //        string sql = "SELECT * FROM employeedetails where employee_id=" + empId;
        //        command.CommandText = sql;
        //        OracleDataReader reader = command.ExecuteReader();
        //        while (reader.Read())
        //        {
        //            employees.Employee_ID = empId;
        //            employees.FirstName = Convert.ToString(reader["FirstName"]);
        //            employees.LastName = Convert.ToString(reader["LastName"]);
        //        }
        //    }
        //    return employees;
        //}
        public void DoWork()
        {
        }

        string IHealthService.json(string id)
        {
            throw new NotImplementedException();
        }

        List<HealthProfile> IHealthService.getHealthProfiles()
        {
            List<HealthProfile> healthprofiles = new List<HealthProfile>();
            string connectionString = "Server=winmysqls03.cpt.wa.co.za;Port=3307;Uid=wits01;Pwd=Pr0ject;Database=waronpoverty;";
            using (MySqlConnection connection = new MySqlConnection())
            {
                connection.ConnectionString = connectionString;
                connection.Open();
                MySqlCommand command = connection.CreateCommand();
                string sql;
                sql = "SELECT * FROM tbl_7046provincedistrictlocalhealthneeds Limit 10";
                command.CommandText = sql;
                MySqlDataReader reader = command.ExecuteReader();
                while (reader.Read())
                {
                    HealthProfile healthpf = new HealthProfile();
                    healthpf.Year = Convert.ToInt32(reader["Year"]);
                    healthpf.Province = Convert.ToString(reader["Province"]);
                    healthpf.District = Convert.ToString(reader["District"]);
                    healthpf.LocalMunicipality = Convert.ToString(reader["LocalMunicipality"]);
                    healthpf.HaveDifficultyVisual = Convert.ToString(reader["HaveDifficultyVisual"]);
                    healthpf.HaveDifficultyHearing = Convert.ToString(reader["HaveDifficultyHearing"]);
                    healthprofiles.Add(healthpf);
                }

               healthprofiles.ToList();

                var jsonSerialiser = new JavaScriptSerializer();
                var json = jsonSerialiser.Serialize(healthprofiles);

                //string result = Newtonsoft.Json.JsonConvert.SerializeObject(healthprofiles, Newtonsoft.Json.Formatting.None);
                
                return healthprofiles;
            }
        }

        HealthProfile IHealthService.getHealthProfilebyProvinceID(int empId)
        {
            throw new NotImplementedException();
        }
    }
}
