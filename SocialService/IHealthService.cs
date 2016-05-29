using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using MySql.Data.MySqlClient;

namespace SocialService
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the interface name "IHealthService" in both code and config file together.
    [ServiceContract]
    public interface IHealthService
    {


        [OperationContract]
        //void DoWork();
        [WebInvoke(Method = "GET",
                   ResponseFormat = WebMessageFormat.Json,
            BodyStyle = WebMessageBodyStyle.Wrapped,
            UriTemplate = "json/id")]
        String json(String id);

        [OperationContract]
        List<HealthProfile> getHealthProfiles();

        [OperationContract]
        HealthProfile getHealthProfilebyProvinceID(Int32 empId);
    }
    [DataContract]
    public class HealthProfile
    {
        public Int32 _Year;
        public string _Province;
        public string _District;
        public string _LocalMunicipality;
        public string _Needs;
        public string _HaveDifficultyVisual;
        public string _HaveDifficultyHearing;

        [DataMember]
        public Int32 Year
        {
            get { return _Year; }
            set { _Year = value; }
        }

        [DataMember]
        public string Province
        {
            get { return _Province; }
            set { _Province = value; }
        }
        [DataMember]
        public string District
        {
            get { return _District; }
            set { _District = value; }
        }
        [DataMember]
        public string LocalMunicipality
        {
            get { return _LocalMunicipality; }
            set { _LocalMunicipality = value; }
        }
        [DataMember]
        public string HaveDifficultyVisual
        {
            get { return _HaveDifficultyVisual; }
            set { _HaveDifficultyVisual = value; }
        }
        [DataMember]
        public string HaveDifficultyHearing
        {
            get { return _HaveDifficultyHearing; }
            set { _HaveDifficultyHearing = value; }
        }
    }
}
